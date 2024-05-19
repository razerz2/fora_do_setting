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
    <h1 class="h3 mb-2 text-gray-800">Sessões</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Valor das sessões por Paciente</h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col md-10">
                    <a href="{{ route('SessaoPaciente.create') }}" class="btn btn-secondary btn-sm"> <i class="fa fa-plus"></i>
                        Adicionar </a>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table id="dataTable" class="table table-sm table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-dark">
                            <th style="width: 8%"> Nº </th>
                            <th> Paciente </th>
                            <th> Dia do Vencimento </th>
                            <th> Valor </th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sessoes_paciente as $sp)
                            <tr class="text-center">
                                <td class="text-center"><small>{{ $sp->id_sp }}</small></td>
                                <td class="text-center"><small>{{ $sp->nome_paciente }}</small></td>
                                <td class="text-center"><small>{{ $sp->dia_vencimento }}</small></td>
                                <td class="text-center"><small>R$ {{ number_format($sp->valor_sessao, 2, ',', '.') }}</small></td>
                                <td align="center">
                                    <a href="{{ route('SessaoPaciente.edit', $sp->id_sp) }}"
                                        class="btn btn-secondary btn-sm"> <i class="fa fa-edit"></i> Editar </a>
                                    <button data-toggle="modal" data-target="#delete" class="btn btn-secondary btn-sm"
                                        onclick="deletar_modal({{ $sp->id_sp }}, '{{ $sp->nome_paciente }}');">
                                        <i class="fa fa-trash"></i> Excluír </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Excluír -->
    <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Deseja Excluír?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form id="desativarForm" action="{{ route('SessaoPaciente.excluir') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja excluír o valor da sessão do Paciente "<span id="info-name"></span>"?
                        </p>
                        <input type="hidden" name="id_sp" id="id_registro" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Excluír</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/sessao_paciente/index.js') }}"></script>
@endsection
