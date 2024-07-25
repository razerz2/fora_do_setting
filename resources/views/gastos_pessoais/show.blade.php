@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Gastos \ <span class="h6 mb-0 text-gray-800"> Gastos Pessoais </span>
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">

        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <form>
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-secondary text-center">Visualizar Gasto
                            Pessoal</h6>
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputtime2">Nº Despesa:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputtime2"
                                        value="{{ $gasto->id_gpe }}" aria-describedby="NDespesaHelp" readonly>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="exampleInputDespesa">Despesa:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputDespesa"
                                        value="{{ $gasto->despesa }}" aria-describedby="nameHelp"
                                        placeholder="Informe o tipo de despesa..." readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="exampleTextarea">Observação:</label>
                                    <textarea class="form-control" id="exampleTextarea" readonly>
                                        {{ $gasto->observacao }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputDataVencimento">Data do Vencimento:</label>
                                    <input type="date" class="form-control form-control-user"
                                        id="exampleInputDataVencimento" value="{{ $gasto->data_vencimento }}"
                                        aria-describedby="emailDataVencimento" placeholder="Informe a data de vencimento..."
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputDataPagamento">Data do Pagamento:</label>
                                    <input type="date" class="form-control form-control-user"
                                        id="exampleInputDataPagamento" value="{{ $gasto->data_pagamento }}"
                                        aria-describedby="emailDataPagamento" placeholder="Informe a data de pagamento..."
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputtime2">Valor da Despesa:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputtime2"
                                        value="R$ {{ number_format($gasto->valor_despesa, 2, ',', '.') }}"
                                        aria-describedby="ValorDespesaHelp" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input id="CheckRec" name="recursivo" class="form-check-input" type="checkbox"
                                        {{ $gasto->recursivo ? 'checked' : '' }} disabled>
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
                                    <a href="{{ route('GastosPessoais.index') }}" class="btn btn-secondary btn-sm"><i
                                            class="fas fa-ban"></i> Voltar </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection