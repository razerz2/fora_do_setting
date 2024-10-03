@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Gastos \ <span class="h6 mb-0 text-gray-800"> Gastos Profissionais </span>
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">

        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <form action="{{ route('GastosProfissionais.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-secondary text-center">Cadastrar Gasto
                            Profissional</h6>
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
                                    <label for="exampleInputDespesa">Despesa:</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputDespesa" value="{{ old('despesa') }}"
                                        name="despesa" aria-describedby="nameHelp" placeholder="Informe o tipo de despesa..."
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="exampleTextarea">Observação:</label>
                                    <textarea class="form-control" id="exampleTextarea" name="observacao" rows="5"></textarea>
                                  </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputDataVencimento">Data do Vencimento:</label>
                                    <input type="date" class="form-control form-control-user"
                                        id="exampleInputDataVencimento" value="{{ old('data_vencimento') }}"
                                        name="data_vencimento" aria-describedby="emailDataVencimento"
                                        placeholder="Informe a data de vencimento..." required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputDataPagamento">Data do Pagamento:</label>
                                    <input type="date" class="form-control form-control-user"
                                        id="exampleInputDataPagamento" value="{{ old('data_pagamento') }}"
                                        name="data_pagamento" aria-describedby="emailDataPagamento"
                                        placeholder="Informe a data de pagamento..." required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputtime2">Valor:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputtime2"
                                        value="{{ old('valor_despesa') }}" name="valor_despesa"
                                        aria-describedby="ValorSessaoHelp" oninput="formatCurrency(this)">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input id="CheckRec" name="recursivo" class="form-check-input" type="checkbox">
                                    <label class="form-check-label" for="CheckRec">
                                        Recursivo
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
                                    <a href="{{ route('GastosProfissionais.index') }}" class="btn btn-secondary btn-sm"><i
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
    </script>
@endsection
