@php
    function adicionarClasse($tipo_agendamento) {
        $color;
        if($tipo_agendamento == 1)
        {
            $color = 'bg-secondary';
        }elseif ($tipo_agendamento == 2) {
            $color = 'bg-white';
        }elseif ($tipo_agendamento == 3) {
            $color = 'bg-light2';
        }
        
        return $color;
    }
@endphp

@extends('layout')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Agenda \ Semanal</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Painel de Agendamentos</h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col md-4">
                    <form action="{{ route('Agendamento.agendaPorDia') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-sm">Diário</button>
                    </form>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-sm table-bordered" width="100%" cellspacing="0">
                    <tr class="table-dark">
                        <th>Período</th>
                        @foreach ($dias_semana as $dia)
                            <th>{{ $dia }}</th>
                        @endforeach
                    </tr>

                    @foreach ($periodos as $periodo)
                        <tr>
                            <td class="p-3 text-center align-middle">{{ $periodo }}</td>
                            @foreach ($dias_semana as $n_dia => $dia)
                                <td class="mb-3 p-3 text-center align-middle">
                                    @if ($calendario[$periodo][$dia]->isEmpty())
                                        Período Livre
                                    @else
                                        <ul>
                                            @foreach ($calendario[$periodo][$dia] as $agendamento)
                                                <li class="p-3 small border border-secondary2 {{ adicionarClasse($agendamento->at_id) }}">
                                                    <a href="#" data-toggle="modal" data-target="#modalDetalhe"
                                                        title="{{ $agendamento->agendamentoTipo->descricao }}"
                                                        onclick="carregarDetalhesAgendamento('{{ $agendamento->id_agendamento }}'); return false;">
                                                        {{ $agendamento->agendamentoTipo->tipo_agendamento }} -
                                                        {{ substr($agendamento->horario_inicial, 0, 5) }} às
                                                        {{ substr($agendamento->horario_final, 0, 5) }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal modal-danger fade" id="modalDetalhe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Detalhe do Agendamento Nº: <span
                            id="modal_n_ag"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div id="agendaDetalhes"class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/agendamento/agenda.js') }}"></script>
@endsection
