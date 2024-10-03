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
    <h1 class="h3 mb-2 text-gray-800">Relatórios</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Relatórios de Pagamentos</h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col md-10">
                    <ul class="list-group list-group-flush">
                        
                        <li class="list-group-item">
                            <ul>
                                <li><a href="#" data-toggle="modal" data-target="#modal_pagamento_paciente">Pagamentos por Paciente</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <ul>
                                <li><a href="#" data-toggle="modal" data-target="#modal_pagamento_periodo">Pagamentos por Período</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <ul>
                                <li><a href="{{ route('Relatorios.PacientesInadimplentes') }}">Pacientes Inadimplentes</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <ul>
                                <li><a href="{{ route('Relatorios.PacientesRecibo') }}">Solicitantes de Recibo</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Pagamento Paciente -->
    <div class="modal modal-danger fade" id="modal_pagamento_paciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Gerar Relatório?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form id="form_pagamento_paciente" action="{{ route('Relatorios.PagamentosPorPaciente') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                            Selecione o paciente para gerar este relatório.
                        </p>
                        <div class="form-group text-center">
                            <label for="list_paciente">Selecione o paciente:</label>
                            <div class="row align-items-center justify-content-center text-center">
                                <div class="col-md-10">
                                    <select id="list_paciente" name="id_paciente"
                                        class="form-control form-control-user text-center" required>
                                        @foreach ($pacientes as $paciente)
                                            <option value="{{ $paciente->id_paciente }}"
                                                {{ old('id_paciente') == $paciente->id_paciente ? 'selected' : '' }}>
                                                {{ $paciente->nome_paciente }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-light">Gerar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Pagamento por Período -->
    <div class="modal modal-danger fade" id="modal_pagamento_periodo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Gerar Relatório?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form id="form_pagamento_periodo" action="{{ route('Relatorios.PagamentosPorPeriodo') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                            Selecione o período que deseja, para gerar este relatório.
                        </p>
                        <div class="form-group text-center">
                            <div class="row align-items-center justify-content-center text-center">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="exampleInputDataA">Data Inicial:</label>
                                        <input type="date" class="form-control form-control-user"
                                            id="exampleInputDataA" value="{{ old('data_a', date('Y-m-d', strtotime('-1 day'))) }}"
                                            name="data_a" aria-describedby="exampleInputDataA"
                                            placeholder="Informe a data de início..." required>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="exampleInputDataB">Data Final:</label>
                                        <input type="date" class="form-control form-control-user"
                                            id="exampleInputDataB" value="{{ old('data_b', date('Y-m-d')) }}"
                                            name="data_b" aria-describedby="exampleInputDataB"
                                            placeholder="Informe a data final.." required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-light">Gerar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
