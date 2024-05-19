@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Agendamentos \ <span class="h6 mb-0 text-gray-800"> Reagendar </span>
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">

        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <form action="{{ route('Agendamento.storeReagendarReserva') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_agendamento" value="{{ $agendamento->id_agendamento }}">
                    <input type="hidden" name="descricao" value="{{ $agendamento->agendamentoReservado->descricao }}">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-secondary text-center">Reservado</h6>
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
                                    <label for="text01">Nº Agendamento:</label>
                                    <input type="text" class="form-control form-control-user" id="text01"
                                        value="{{ $agendamento->id_agendamento }}" name="agendamento_id"
                                        aria-describedby="AgendamentoHelp" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="text02">Descrição:</label>
                                    <input type="text" class="form-control form-control-user" id="text02"
                                        value="{{ $agendamento->agendamentoReservado->descricao }}"
                                        aria-describedby="PeriodoHelp" disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="text03">Dia da Semana:</label>
                                    <input type="text" class="form-control form-control-user" id="text03"
                                        value="{{ $agendamento->dia }}" 
                                        aria-describedby="DiaHelp" disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="text04">Horário:</label>
                                    <input type="text" class="form-control form-control-user" id="text04"
                                        value="{{substr($agendamento->horario_inicial, 0, 5)}} às {{substr($agendamento->horario_final, 0, 5)}}" 
                                        aria-describedby="HorarioHelp" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="list_horarios">Horários Livres:</label>
                                    <select id="list_horarios" name="agendamento_id" class="form-control form-control-user" required>
                                        @foreach ($agendamentos_livres as $al)
                                            <option value="{{ $al->id_agendamento }}" {{ old('agendamento_id') == $al->id_agendamento ? 'selected' : '' }}>
                                                Nº {{ $al->id_agendamento }}  ;  Dia: {{ $al->dia }}  ;  Horário:  {{substr($al->horario_inicial, 0, 5)}}hrs às {{substr($al->horario_final, 0, 5)}}hrs
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input id="CheckPresencial" class="form-check-input" type="checkbox" name="presencial" {{ $agendamento->agendamentoReservado->presencial ? 'checked' : '' }}>
                                    <label class="form-check-label" for="CheckPresencial">
                                        Presencial
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="CheckOnline" class="form-check-input" type="checkbox" name="online" {{ !$agendamento->agendamentoReservado->presencial ? 'checked' : '' }}>
                                    <label class="form-check-label" for="CheckPresencial">
                                        Online
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
    <script src="{{ asset('js/agendamento/create.js') }}"></script>
@endsection
