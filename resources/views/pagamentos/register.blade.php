@extends('layout')

@section('content')
    <!-- Error message -->
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="fa-solid fa-triangle-exclamation"></i> Atenção, </strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pagamentos</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Confirmar Sessões</h6>
        </div>
        <form id="formSeletedCheck" action="{{ route('Pagamentos.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="exampleInputNomePaciente">Nome do Paciente:</label>
                            <input type="text" class="form-control form-control-user" id="exampleInputNomePaciente"
                                value="{{ $data['paciente_nome'] }}" aria-describedby="nameHelp"
                                placeholder="Nome Completo..." readonly>
                            <input type="hidden" name="paciente_id" value="{{ $data['paciente_id'] }}">
                            <input type="hidden" name="dia_vencimento" value="{{ $data['dia_vencimento'] }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleMes">Mês:</label>
                            <input type="text" class="form-control form-control-user" id="exampleMes"
                                value="{{ $data['mes_nome'] }}" aria-describedby="nameHelp" readonly>
                            <input type="hidden" name="mes_referente" value="{{ $data['mes_nome'] }}">
                            <input type="hidden" name="n_mes_referente" value="{{ $data['mes'] }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleAno">Ano:</label>
                            <input type="text" class="form-control form-control-user" id="exampleInputAno"
                                value="{{ $data['ano'] }}" aria-describedby="nameHelp" readonly>
                            <input type="hidden" name="ano_referente" value="{{ $data['ano'] }}">
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
                                        <th style="width: 8%"> Nº Sessao </th>
                                        <th> Data </th>
                                        <th> Valor </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sessoes as $sessao)
                                        <tr class="text-center">
                                            <td class="text-center"><small>{{ $sessao->id_sessao }}</small></td>
                                            <td class="text-center">
                                                <small>{{ \Carbon\Carbon::parse($sessao->data_sessao)->format('d/m/Y') }}</small>
                                            </td>
                                            <td class="text-center"><small>R$
                                                    {{ number_format($sessao->valor_sessao, 2, ',', '.') }}</small></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row align-items-center justify-content-end">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="InputDataPagamento">Data Pagamento:</label>
                            <input type="date" class="form-control form-control-user" id="InputDataPagamento"
                                value="{{ old('data_pagamento', date('Y-m-d')) }}" name="data_pagamento"
                                aria-describedby="emailDataPagamento" placeholder="Informe a data de pagamento..."
                                required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="InputValorTotal">Valor Total:</label>
                            <input type="text" class="form-control form-control-user" id="InputValorTotal"
                                value="R$ {{ number_format($data['total_valor'], 2, ',', '.') }}"
                                aria-describedby="nameHelp" readonly>
                            <input type="hidden" name="valor_pagamento" value="{{ $data['total_valor'] }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col md-10">
                        <a href="{{ route('Pagamentos.create') }}" class="btn btn-secondary btn-sm"> <i
                                class="fa fa-ban"></i>
                            Cancelar </a>
                        <button type="submit" class="btn btn-secondary btn-sm"> <i class="fa fa-check"></i>
                            Lançar Pagamento </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
