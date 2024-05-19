@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Sessões \ <span class="h6 mb-0 text-gray-800"> Sessões Paciente </span>
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">

        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <form action="{{ route('SessaoPaciente.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-secondary text-center">Cadastro dos valores de sessões por
                            paciente</h6>
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
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="select_pacientes">Pacientes:</label>
                                    <select id="select_pacientes" name="paciente_id" class="form-control form-control-user"
                                        required>
                                        @foreach ($pacientes as $paciente)
                                            <option value="{{ $paciente->id_paciente }}"
                                                {{ old('ap_id') == $paciente->id_paciente ? 'selected' : '' }}>
                                                {{ $paciente->nome_paciente }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputtime1">Dia do Vencimento:</label>
                                    <input type="number" class="form-control form-control-user" id="exampleInputtime1"
                                        value="{{ old('dia_vencimento') }}" name="dia_vencimento"
                                        aria-describedby="DiaVencimentoHelp" oninput="validateDay(this)">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputtime2">Valor da Sessão:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputtime2"
                                        value="{{ old('valor_sessao') }}" name="valor_sessao"
                                        aria-describedby="ValorSessaoHelp"  oninput="formatCurrency(this)">
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
    <script>
        function formatCurrency(input) {
            let value = input.value;

            // Remove todos os caracteres que não sejam dígitos ou ponto
            value = value.replace(/\D/g, '');

            // Adiciona vírgula como separador de decimais
            if (value.length > 2) {
                value = value.slice(0, -2) + ',' + value.slice(-2);
            }

            // Adiciona ponto como separador de milhar
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            input.value = value ? 'R$ ' + value : '';
        }

        function validateDay(input) {
            let value = parseInt(input.value, 10);

            if (isNaN(value)) {
                input.value = '';
                return;
            }

            if (value < 1) {
                input.value = 1;
            } else if (value > 30) {
                input.value = 30;
            }
        }
    </script>
@endsection
