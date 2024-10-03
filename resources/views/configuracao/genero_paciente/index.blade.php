@extends('layout')

@section('content')
    <!-- Error message -->
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="fa-solid fa-triangle-exclamation"></i> Atenção, </strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        @foreach (collect($errors->all())->sort() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Gênero para Pacientes</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Gêneros</h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col md-10">
                    <a data-toggle="modal" data-target="#criar" class="btn btn-secondary btn-sm"> <i class="fa fa-plus"></i>
                        Adicionar </a>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table id="dataTable" class="table table-sm table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-dark">
                            <th style="width: 5%"> ID </th>
                            <th> Gênero </th>
                            <th> Abreviatura </th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($generos as $genero)
                            <tr class="text-center">
                                <td class="text-center"><small>{{ $genero->id_genero }}</small></td>
                                <td class="text-center"><small>{{ $genero->nome_genero }}</small></td>
                                <td class="text-center"><small>{{ $genero->abreviatura }}</small></td>
                                <td align="center">
                                    <button type="button" data-toggle="modal" data-target="#editar"
                                        class="btn btn-secondary btn-sm"
                                        onclick="editar_genero({{ $genero->id_genero }}, '{{ $genero->nome_genero }}', '{{ $genero->abreviatura }}');">
                                        <i class="fa fa-edit"></i> Editar </button>
                                    <button type="button" data-toggle="modal" data-target="#excluir"
                                        class="btn btn-secondary btn-sm"
                                        onclick="excluir_genero({{ $genero->id_genero }}, '{{ $genero->nome_genero }}');">
                                        <i class="fa fa-ban"></i> Excluir </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Criar -->
    <div class="modal modal-danger fade" id="criar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Criar novo motivo para gênero</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('PacienteGenero.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="md_edit_nome_motivo">Gênero: </label>
                                    <input type="text" class="form-control form-control-user" value=""
                                        name="nome_genero" aria-describedby="nameHelp"
                                        placeholder="Informe o nome para este gênero..." required>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="md_edit_nome_motivo">Abreviatura: </label>
                                    <input type="text" class="form-control form-control-user" value=""
                                        name="abreviatura" aria-describedby="nameHelp"
                                        placeholder="Informe a abreviatura..." required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-light">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Editar -->
    <div class="modal modal-danger fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Editar Gênero Nº<span
                            id="md-editar-span-id_genero"></span> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('PacienteGenero.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_genero" id="md-editar-id_genero" value="">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="md_edit_nome_genero">Gênero: </label>
                                    <input type="text" class="form-control form-control-user"
                                        id="md-editar-nome_genero" value="" name="nome_genero"
                                        aria-describedby="nameHelp" placeholder="Informe o gênero..." required>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="md_edit_abreviatura">Abreviatura: </label>
                                    <input type="text" class="form-control form-control-user"
                                        id="md-editar-abreviatura" value="" name="abreviatura"
                                        aria-describedby="nameHelp" placeholder="Informe a abreviatura..." required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-light">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Excluír -->
    <div class="modal modal-danger fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel"> Excluir Nº <span
                            id="md-excluir-span-id_genero"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('PacienteGenero.destroy') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja excluir o gênero "<span id="md-excluir-span-nome_genero"></span>"?
                        </p>
                        <input type="hidden" name="id_genero" id="md-excluir-id_genero" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-light">Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/configuracoes/paciente_genero/index.js') }}"></script>
@endsection
