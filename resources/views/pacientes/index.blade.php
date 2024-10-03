@php
    function formatarCPF($cpf)
    {
        // Limpar o CPF removendo caracteres especiais
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Adicionar a máscara de CPF
        $cpfFormatado =
            substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);

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
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex">
                        <!-- Botão à esquerda -->
                        <a href="{{ route('Pacientes.create') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-plus"></i> Adicionar
                        </a>
            
                        <!-- Botão à direita com ml-auto -->
                        <a href="{{ route('Pacientes.inativos') }}" class="btn btn-secondary btn-sm ml-auto">
                            <i class="fa fa-ban" aria-hidden="true"></i> Inativos
                        </a>
                    </div>
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
                                <td align="center">
                                    <a href="{{ route('Pacientes.verificaEnderecoPaciente', ['paciente' => $paciente->id_paciente]) }}"
                                        class="btn btn-secondary btn-sm"> <i class="fa fa-map"></i> Endereço </a>
                                    <a href="{{ route('Pacientes.show', ['paciente' => $paciente->id_paciente]) }}"
                                        class="btn btn-secondary btn-sm"> <i class="fa fa-eye"></i> Visualizar </a>
                                    <a href="{{ route('Pacientes.edit', ['paciente' => $paciente->id_paciente]) }}"
                                        class="btn btn-secondary btn-sm"> <i class="fa fa-edit"></i> Editar </a>
                                    <button data-toggle="modal" data-target="#desativar" class="btn btn-secondary btn-sm"
                                        onclick="desativar_modal({{ $paciente->id_paciente }}, '{{ $paciente->nome_paciente }}');">
                                        <i class="fa fa-trash"></i> Desativar </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal modal-danger fade" id="desativar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Deseja desativar?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form id="desativarForm" action="{{ route('Pacientes.desativar') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja desativar "<span id="info-name"></span>"?
                        </p>
                        <input type="hidden" name="paciente_id" id="id_usuario" value="">
                        <div class="col-md-20">
                            <div class="form-group">
                                <label for="exampleInputMotivoInativacao">Motivo da Inativação:</label>
                                <select id="exampleInputMotivoInativacao" name="mi_id"
                                    class="form-control form-control-user text-center" required>
                                    @foreach ($motivos as $motivo)
                                        <option value="{{ $motivo->id_mi }}">{{ $motivo->nome_mi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Desativar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/pacientes/index.js') }}"></script>
@endsection
