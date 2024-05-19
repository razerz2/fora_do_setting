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
                <form action="{{ route('SessaoPaciente.update', ['SessaoPaciente' => $sessao_paciente->id_sp]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="hidden" name="id_sp" value="{{ $sessao_paciente->id_sp }}">
                    <input type="hidden" name="paciente_id" value="{{ $paciente->id_paciente }}">
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
                                    <label for="select_pacientes">Paciente:</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputNomePaciente" value="{{$paciente->nome_paciente}}"
                                        name="nome_paciente" aria-describedby="nameHelp" placeholder="Nome Completo..." disabled>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputtime1">Dia do Vencimento:</label>
                                    <input type="number" class="form-control form-control-user" id="exampleInputtime1"
                                        value="{{ old('dia_vencimento', $sessao_paciente->dia_vencimento) }}" name="dia_vencimento"
                                        aria-describedby="DiaVencimentoHelp" oninput="validateDay(this)">
                                        
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputtime2">Valor da Sessão:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputtime2"
                                        value="R$ {{ old('valor_sessao', number_format($sessao_paciente->valor_sessao, 2, ',', '.')) }}" name="valor_sessao"
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
                                    <a href="{{ route('SessaoPaciente.index') }}" class="btn btn-secondary btn-sm"><i
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
