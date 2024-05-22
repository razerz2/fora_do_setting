@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Sessões \ <span class="h6 mb-0 text-gray-800"> Visualizar Sessão </span>
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">
        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                    <h6 class="m-0 font-weight-bold text-secondary text-center">Sessão</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="text01">Nº Sessão:</label>
                                <input type="text" class="form-control form-control-user" id="text01"
                                    value="{{ $sessao->id_agendamento }}" name="agendamento_id"
                                    aria-describedby="AgendamentoHelp" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="text02">Paciente:</label>
                                <input type="text" class="form-control form-control-user" id="text02"
                                    value="{{ $sessao->nome_paciente }}" aria-describedby="PeriodoHelp"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="text03">Valor:</label>
                                <input type="text" class="form-control form-control-user" id="text03"
                                    value="R$ {{ number_format($sessao->valor_sessao, 2, ',', '.') }}" aria-describedby="DiaHelp" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="text04">Nº do Ag.</label>
                                <input type="text" class="form-control form-control-user" id="text04"
                                    value="{{ $sessao->agendamento_id }}" name="agendamento_id"
                                    aria-describedby="AgendamentoHelp" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="text05">Período:</label>
                                <input type="text" class="form-control form-control-user" id="text05"
                                    value="{{ $sessao->periodo }}" aria-describedby="PeriodoHelp"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="text06">Dia da Semana:</label>
                                <input type="text" class="form-control form-control-user" id="text06"
                                    value="{{ $sessao->dia }}" aria-describedby="DiaHelp" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="text07">Horário Inicial:</label>
                                <input type="text" class="form-control form-control-user" id="text04"
                                    value="{{ substr($sessao->horario_inicial, 0, 5) }} às {{ substr($sessao->horario_final, 0, 5) }}"
                                    aria-describedby="HorarioHelp" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
