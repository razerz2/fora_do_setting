@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Pagamentos \ <span class="h6 mb-0 text-gray-800"> Visualizar Pagamento </span>
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
                        <h6 class="m-0 font-weight-bold text-secondary text-center">Pagamento Nº {{ $pagamento->id_pagamento }}</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputNomePaciente">Nome do Paciente:</label>
                                    <input type="text" class="form-control form-control-user text-center" id="InputNomePaciente"
                                        value="{{ $pagamento->nome_paciente }}" aria-describedby="nameHelp"
                                        placeholder="Nome Completo..." readonly>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="InputMes">Mês:</label>
                                    <input type="text" class="form-control form-control-user text-center" id="InputMes"
                                        value="{{ $pagamento->mes_referente }}" aria-describedby="nameHelp" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="InputAno">Ano:</label>
                                    <input type="text" class="form-control form-control-user text-center" id="InputAno"
                                    value="{{ $pagamento->ano_referente }}" aria-describedby="nameHelp" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="InputDataPagamento">Data de Pagamento:</label>
                                    <input type="text" class="form-control form-control-user text-center" id="InputDataPagamento"
                                        value="{{ \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y') }}" name="data_pagamento"
                                        aria-describedby="emailDataPagamento" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="InputValorTotal">Valor Total:</label>
                                    <input type="text" class="form-control form-control-user text-center" id="InputValorTotal"
                                        value="R$ {{ number_format($pagamento->valor_pagamento, 2, ',', '.') }}"
                                        aria-describedby="nameHelp" readonly>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center justify-content-center">
                            <div class="col md-10">
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-sm table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="table-dark">
                                                <th style="width: 10%"> Nº Sessao </th>
                                                <th> Data </th>
                                                <th> Valor </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sessoes as $sessao)
                                                <tr class="text-center">
                                                    <td class="text-center"><small>{{ $sessao->sessao_id }}</small></td>
                                                    <td class="text-center">
                                                        <small>{{ \Carbon\Carbon::parse($sessao->data_sessao)->format('d/m/Y') }}</small>
                                                    </td>
                                                    <td class="text-center"><small>R$
                                                            {{ number_format($sessao->valor, 2, ',', '.') }}</small></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
