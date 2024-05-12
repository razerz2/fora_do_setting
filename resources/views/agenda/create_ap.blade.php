@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Agendamentos \ <span class="h6 mb-0 text-gray-800"> Marcar Atendimento </span>
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">

        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <form action="{{ route('Agendamento.storePaciente') }}" method="post">
                    @csrf
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-secondary text-center">Atendimento</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="hidden" name="at_id" value="{{ $tipo_agendamento }}">
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
                                        value="{{ $agendamento->agendamentoPeriodo->periodo }}"
                                        aria-describedby="PeriodoHelp" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="text03">Dia da Semana:</label>
                                    <input type="text" class="form-control form-control-user" id="text03"
                                        value="{{ $agendamento->dia }}" 
                                        aria-describedby="DiaHelp" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="text04">Horários:</label>
                                    <input type="text" class="form-control form-control-user" id="text04"
                                        value="{{substr($agendamento->horario_inicial, 0, 5)}} às {{substr($agendamento->horario_final, 0, 5)}}" 
                                        aria-describedby="HorarioHelp" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="list_paciente">Pacientes:</label>
                                    <select id="list_paciente" name="paciente_id" class="form-control form-control-user" required>
                                        @foreach ($pacientes as $paciente)
                                            <option value="{{ $paciente->id_paciente }}" {{ old('paciente_id') == $paciente->id_paciente ? 'selected' : '' }}>
                                                {{ $paciente->nome_paciente }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input id="CheckPresencial" class="form-check-input" type="checkbox" name="presencial">
                                    <label class="form-check-label" for="CheckPresencial">
                                        Presencial?
                                    </label>
                                </div>
                            </div>                          
                        </div>

                    </div>
                    <!-- Card Body -->
                    <div class="card-footer">
                        <div class="row align-items-center justify-content-center text-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <a href="{{ route('Agendamento.index') }}" class="btn btn-secondary btn-sm"><i
                                            class="fas fa-ban"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-dark btn-sm"><i class="fas fa-save"></i>
                                        Salvar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
