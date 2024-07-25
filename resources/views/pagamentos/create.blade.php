@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Pagamentos \ <span class="h6 mb-0 text-gray-800"> Informar Paciente </span>
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">


        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <form action="{{ route('Pagamentos.registrar') }}" method="post">
                    @csrf
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-secondary text-center">Selecionar Paciente</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Error message -->
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-triangle-exclamation"></i> Atenção, </strong>
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="list_paciente">Pacientes:</label>
                                    <select id="list_paciente" name="paciente_id" class="form-control form-control-user"
                                        required>
                                        @foreach ($pacientes as $paciente)
                                            <option value="{{ $paciente->id_paciente }}"
                                                {{ old('paciente_id') == $paciente->id_paciente ? 'selected' : '' }}>
                                                {{ $paciente->nome_paciente }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="list_meses">Mês:</label>
                                    <select id="list_meses" name="mes" class="form-control form-control-user" required>
                                        <option value="1" {{ date('n') == 1 ? 'selected' : '' }}>Janeiro</option>
                                        <option value="2" {{ date('n') == 2 ? 'selected' : '' }}>Fevereiro</option>
                                        <option value="3" {{ date('n') == 3 ? 'selected' : '' }}>Março</option>
                                        <option value="4" {{ date('n') == 4 ? 'selected' : '' }}>Abril</option>
                                        <option value="5" {{ date('n') == 5 ? 'selected' : '' }}>Maio</option>
                                        <option value="6" {{ date('n') == 6 ? 'selected' : '' }}>Junho</option>
                                        <option value="7" {{ date('n') == 7 ? 'selected' : '' }}>Julho</option>
                                        <option value="8" {{ date('n') == 8 ? 'selected' : '' }}>Agosto</option>
                                        <option value="9" {{ date('n') == 9 ? 'selected' : '' }}>Setembro</option>
                                        <option value="10" {{ date('n') == 10 ? 'selected' : '' }}>Outubro</option>
                                        <option value="11" {{ date('n') == 11 ? 'selected' : '' }}>Novembro</option>
                                        <option value="12" {{ date('n') == 12 ? 'selected' : '' }}>Dezembro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="list_anos">Ano:</label>
                                    <select id="list_anos" name="ano" class="form-control form-control-user" required>
                                        @foreach ($anos as $ano)
                                            <option value="{{ $ano }}" {{ $ano == date('Y') ? 'selected' : '' }}>
                                                {{ $ano }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Card Body -->
                    <div class="card-footer">
                        <div class="row align-items-center justify-content-center text-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <a href="{{ route('Pagamentos.index') }}" class="btn btn-secondary btn-sm"><i
                                            class="fas fa-ban"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-dark btn-sm"><i class="fas fa-save"></i>
                                        Verificar</button>
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
