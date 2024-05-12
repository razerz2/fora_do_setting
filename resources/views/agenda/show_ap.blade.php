@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Agendamentos \ <span class="h6 mb-0 text-gray-800"> Visualizar Agendamento </span>
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">
        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                    <h6 class="m-0 font-weight-bold text-secondary text-center">Agendamento para Paciente</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="text01">Nº Agendamento:</label>
                                <input type="text" class="form-control form-control-user" id="text01"
                                    value="{{ $agendamento->id_agendamento }}" name="agendamento_id"
                                    aria-describedby="AgendamentoHelp" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="text02">Período:</label>
                                <input type="text" class="form-control form-control-user" id="text02"
                                    value="{{ $agendamento->agendamentoPeriodo->periodo }}" aria-describedby="PeriodoHelp"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="text03">Dia da Semana:</label>
                                <input type="text" class="form-control form-control-user" id="text03"
                                    value="{{ $agendamento->dia }}" aria-describedby="DiaHelp" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="text04">Horários:</label>
                                <input type="text" class="form-control form-control-user" id="text04"
                                    value="{{ substr($agendamento->horario_inicial, 0, 5) }} às {{ substr($agendamento->horario_final, 0, 5) }}"
                                    aria-describedby="HorarioHelp" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="text05">Paciente:</label>
                                <input type="text" class="form-control form-control-user" id="text05" value="{{ $agendamentosDetalhes[0]->nome_paciente}}"
                                    aria-describedby="HorarioHelp" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="text06">Presencial:</label>
                                <input type="text" class="form-control form-control-user" id="text06" value="{{ isset($agendamentosDetalhes[0]->presencial) ? "Sim" : "Não" }}"
                                    aria-describedby="HorarioHelp" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
