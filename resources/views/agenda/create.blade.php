@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Agendamentos \ <span class="h6 mb-0 text-gray-800"> Cadastrar Horário </span>
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">

        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <form action="{{ route('Agendamento.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-secondary text-center">Cadastro de Horários</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach (collect($errors->all())->sort() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="agendamento_periodo">Período:</label>
                                    <select id="agendamento_periodo" name="ap_id" class="form-control form-control-user"
                                        required>
                                        @foreach ($periodos as $periodo)
                                            <option value="{{ $periodo->id_ap }}"
                                                {{ old('ap_id') == $periodo->id_ap ? 'selected' : '' }}>
                                                {{ $periodo->periodo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="n_dia">Dia da Semana:</label>
                                    <select id="n_dia" name="n_dia" class="form-control form-control-user" required>
                                        <option value="1" {{ old('n_dia') == 1 ? 'selected' : '' }}>Segunda</option>
                                        <option value="2" {{ old('n_dia') == 2 ? 'selected' : '' }}>Terça</option>
                                        <option value="3" {{ old('n_dia') == 3 ? 'selected' : '' }}>Quarta</option>
                                        <option value="4" {{ old('n_dia') == 4 ? 'selected' : '' }}>Quinta</option>
                                        <option value="5" {{ old('n_dia') == 5 ? 'selected' : '' }}>Sexta</option>
                                        <option value="6" {{ old('n_dia') == 6 ? 'selected' : '' }}>Sábado</option>
                                        <option value="7" {{ old('n_dia') == 7 ? 'selected' : '' }}>Domingo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputtime">Horário Inicial:</label>
                                    <input type="time" class="form-control form-control-user" id="exampleInputtime"
                                        value="{{ old('horario_inicial') }}" name="horario_inicial"
                                        aria-describedby="HorarioHelp">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputtime2">Horário Final:</label>
                                    <input type="time" class="form-control form-control-user" id="exampleInputtime2"
                                        value="{{ old('horario_final') }}" name="horario_final"
                                        aria-describedby="HorarioHelp">
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
