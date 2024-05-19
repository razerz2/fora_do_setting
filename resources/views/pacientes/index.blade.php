@php
    function formatarCPF($cpf) {
        // Limpar o CPF removendo caracteres especiais
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Adicionar a máscara de CPF
        $cpfFormatado = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);

        return $cpfFormatado;
    }
@endphp

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

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pacientes</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Pacientes Cadastrados</h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col md-10">
                    <a href="{{ route('Pacientes.create') }}" class="btn btn-secondary btn-sm"> <i class="fa fa-plus"></i>
                        Adicionar </a>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table id="dataTable" class="table table-sm table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-dark">
                            <th style="width: 8%">ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pacientes as $paciente)
                            <tr class="text-center">
                                <td class="text-center"><small>{{ $paciente->id_paciente }}</small></td>
                                <td class="text-center"><small>{{ $paciente->nome_paciente }}</small></td>
                                <td class="text-center"><small>{{ formatarCPF($paciente->cpf) }}</small></td>
                                <td class="text-center"><small>{{ $paciente->email }}</small></td>
                                <td class="text-center"><small>{{ $paciente->status }}</small></td>
                                <td align="center">
                                    <a href="{{ route('Pacientes.verificaEnderecoPaciente', ['paciente' => $paciente->id_paciente]) }}"
                                        class="btn btn-secondary btn-sm"> <i class="fa fa-map"></i> Endereço </a>
                                    <a href="{{ route('Pacientes.show', ['paciente' => $paciente->id_paciente]) }}"
                                        class="btn btn-secondary btn-sm"> <i class="fa fa-eye"></i> Visualizar </a>
                                    <a href="{{ route('Pacientes.edit', ['paciente' => $paciente->id_paciente]) }}"
                                        class="btn btn-secondary btn-sm"> <i class="fa fa-edit"></i> Editar </a>
                                    @if ($paciente->status == 'ativo')
                                        <button data-toggle="modal" data-target="#delete" class="btn btn-secondary btn-sm"
                                            onclick="deletar_modal({{ $paciente->id_paciente }}, '{{ $paciente->nome_paciente }}');">
                                            <i class="fa fa-trash"></i> Desativar </button>
                                    @else
                                        <button data-toggle="modal" data-target="#ativar" class="btn btn-secondary btn-sm"
                                            onclick="ativar_modal({{ $paciente->id_paciente }}, '{{ $paciente->nome_paciente }}');">
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
                <form id="desativarForm" action="" method="GET">
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja desativar "<span id="info-name"></span>"?
                        </p>
                        <input type="hidden" name="id_paciente" id="id_usuario" value="">
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
                <form action="{{ route('Pacientes.ativar') }}" method="POST">
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
    <script src="{{ asset('js/pacientes/index.js') }}"></script>
@endsection
