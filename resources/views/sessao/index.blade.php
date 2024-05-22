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
            <h6 class="text-center m-0 font-weight-bold text-secondary">Sessões Registradas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-sm table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-dark">
                            <th style="width: 8%"> Nº </th>
                            <th> Paciente </th>
                            <th> Valor </th>
                            <th> Dia da Semana </th>
                            <th> Horário </th>
                            <th> Data </th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sessoes as $sessao)
                            <tr class="text-center">
                                <td class="text-center"><small>{{ $sessao->id_sessao }}</small></td>
                                <td class="text-center"><small>{{ $sessao->nome_paciente }}</small></td>
                                <td class="text-center"><small><small>R$ {{ number_format($sessao->valor_sessao, 2, ',', '.') }}</small></td>
                                <td class="text-center"><small>{{ $sessao->dia }}</small></td>
                                <td class="text-center"><small>{{ substr($sessao->horario_inicial, 0, 5) }} às
                                        {{ substr($sessao->horario_final, 0, 5) }}</small></td>
                                <td class="text-center">
                                    <small>{{ \Carbon\Carbon::parse($sessao->data_sessao)->format('d/m/Y') }}</small>
                                </td>
                                <td align="center">
                                    <a href="{{ route('Sessao.show', ['sessao' => $sessao->id_sessao]) }}"
                                        class="btn btn-secondary btn-sm"> <i class="fa fa-eye"></i> Visualizar </a>
                                    <button data-toggle="modal" data-target="#delete" class="btn btn-secondary btn-sm"
                                        onclick="deletar_modal({{ $sessao->id_sessao }}, '{{ $sessao->nome_paciente }}');">
                                        <i class="fa fa-trash"></i> Excluir </button>
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
                <form id="desativarForm" action="{{ route('Sessao.excluir') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja excluír sessao Nº "<span id="info-sessao-n"></span>" do Paciente: "<span id="info-sessao"></span>"?
                        </p>
                        <input type="hidden" name="id_sessao" id="id_sessao" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Excluír</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/sessao/index.js') }}"></script>
@endsection
