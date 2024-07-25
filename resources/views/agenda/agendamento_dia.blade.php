@extends('layout')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Agenda \ Diária</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Painel de Agendamentos</h6>
        </div>
        <div class="card-body">
            <div class="row align-items-center justify-content-between">
                <div class="col md-5">
                    <a href="{{ route('Agendamento.agenda') }}" class="btn btn-secondary btn-sm"> Semanal </a>
                </div>
                <div class="col-md-5">
                    <form action="{{ route('Agendamento.agendaPorDia') }}" method="POST">
                        @csrf
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-4 text-md-right">
                                <label for="n_dia" class="mb-0">Selecione o dia:</label>
                            </div>
                            <div class="col-md-4">
                                <select id="n_dia" name="n_dia" class="form-control form-control-user" required>
                                    <option value="1" {{ old('n_dia', $diaSelecionado) == 1 ? 'selected' : '' }}>Segunda</option>
                                    <option value="2" {{ old('n_dia', $diaSelecionado) == 2 ? 'selected' : '' }}>Terça</option>
                                    <option value="3" {{ old('n_dia', $diaSelecionado) == 3 ? 'selected' : '' }}>Quarta</option>
                                    <option value="4" {{ old('n_dia', $diaSelecionado) == 4 ? 'selected' : '' }}>Quinta</option>
                                    <option value="5" {{ old('n_dia', $diaSelecionado) == 5 ? 'selected' : '' }}>Sexta</option>
                                    <option value="6" {{ old('n_dia', $diaSelecionado) == 6 ? 'selected' : '' }}>Sábado</option>
                                    <option value="7" {{ old('n_dia', $diaSelecionado) == 7 ? 'selected' : '' }}>Domingo</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-secondary btn-sm">Verificar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-sm table-bordered" width="100%" cellspacing="0">
                    <tr class="table-dark">
                        <th style="width: 10%">Período</th>
                        <th>{{ $dias_semana[$diaSelecionado] }}</th>
                    </tr>

                    @foreach ($periodos as $periodo)
                        <tr>
                            <td class="p-3 text-center align-middle">{{ $periodo }}</td>
                            <td class="mb-3 p-3 text-center align-middle">
                                @if ($calendario[$periodo]->isEmpty())
                                    Período Livre
                                @else
                                    <ul>
                                        @foreach ($calendario[$periodo] as $agendamento)
                                            <li class="p-3 text-dark small border border-secondary2 bg-white">
                                                
                                                <p>Tipo:  {{ $agendamento->agendamentoTipo->tipo_agendamento }} </p><br>
                                                @if ($agendamento->at_id == 1)
                                                <p>Nome Paciente:  {{ $agendamento->agendamentoPaciente->paciente->nome_paciente }} </p><br>
                                                @elseif ($agendamento->at_id == 3)
                                                <p>Descrição:  {{ $agendamento->agendamentoReservado->descricao }} </p><br>
                                                @endif
                                                <p>Dia da semana:  {{ $agendamento->dia }} </p><br>
                                                <p>Período:  {{ $agendamento->agendamentoPeriodo->periodo }} </p><br>
                                                <p>Horário Inicial:   {{ substr($agendamento->horario_inicial, 0, 5) }}Hrs </p><br>
                                                <p>Horário Final:  {{ substr($agendamento->horario_final, 0, 5) }}Hrs </p><br>
                                                @if ($agendamento->at_id == 1)
                                                <p>Modalidade:  {{ $agendamento->agendamentoPaciente->presencial ? 'Presencial' : 'Online' }} </p><br>
                                                @elseif ($agendamento->at_id == 3)
                                                <p>Modalidade: {{ $agendamento->agendamentoReservado->presencial ? 'Presencial' : 'Online' }} </p><br>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
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
