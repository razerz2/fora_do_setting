@extends('layout')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Usuários</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Usuários Cadastrados</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-sm table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-dark">
                            <th style="width: 8%">ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td class="text-center"><small>{{ $usuario->id }}</small></td>
                                <td class="text-center"><small>{{ $usuario->name }}</small></td>
                                <td class="text-center"><small>{{ $usuario->email }}</small></td>
                                <td class="text-center"><small>{{ $usuario->status }}</small></td>
                                <td align="center">
                                    <a href="{{ route('Users.edit', ['usuario' => $usuario->id]) }}"
                                        class="btn btn-secondary btn-sm"> <i class="fa fa-edit"></i> Editar </a>
                                    <a href="{{ route('Users.editPassword', ['usuario' => $usuario->id]) }}"
                                        class="btn btn-secondary btn-sm"> <i class="fa fa-key"></i> Change</a>
                                    @if ($usuario->status == 'ativo')
                                        <button data-toggle="modal" data-target="#delete" class="btn btn-secondary btn-sm"
                                            onclick="deletar_modal({{ $usuario->id }}, '{{ $usuario->name }}');">
                                            <i class="fa fa-trash"></i> Desativar </button>
                                    @else
                                        <button data-toggle="modal" data-target="#ativar" class="btn btn-secondary btn-sm"
                                            onclick="ativar_modal({{ $usuario->id }}, '{{ $usuario->name }}');">
                                            <i class="fa fa-trash"></i> Ativar </button>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Deseja desativar?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('Users.desativar') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja desativar "<span id="info-name"></span>"?
                        </p>
                        <input type="hidden" name="id_usuario" id="id_usuario" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Desativar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal modal-danger fade" id="ativar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Deseja ativar?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('Users.ativar') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja ativar "<span id="info-name-at"></span>"?
                        </p>
                        <input type="hidden" name="id_usuario" id="id_usuario_at" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Ativar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/users/index.js') }}"></script>
@endsection
