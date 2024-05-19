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
    <h1 class="h3 mb-2 text-gray-800">Agendamentos</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Confirmar Atendimentos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-sm table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-dark">
                            <th style="width: 5%"> # </th>
                            <th style="width: 8%"> Nº </th>
                            <th> Paciente </th>
                            <th> Dia da Semana </th>
                            <th> Horário </th>
                            <th> Data </th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agendamentos as $agendamento)
                            <tr class="text-center">
                                <td class="text-center"><small>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $agendamento->id_agendamento }}" name="selected[]" id="check-{{ $agendamento->id_agendamento }}">                 
                                </small></td>
                                <td class="text-center"><small>{{ $agendamento->id_agendamento }}</small></td>
                                <td class="text-center"><small>{{ $agendamento->nome_paciente }}</small></td>
                                <td class="text-center"><small>{{ $agendamento->dia }}</small></td>
                                <td class="text-center"><small>{{ substr($agendamento->horario_inicial, 0, 5) }} às
                                        {{ substr($agendamento->horario_final, 0, 5) }}</small></td>
                                <td class="text-center">
                                    <small>{{ \Carbon\Carbon::parse($agendamento->data_registro)->format('d/m/Y') }}</small>
                                </td>
                                <td align="center">
                                    <button data-toggle="modal" data-target="#validar" class="btn btn-secondary btn-sm"
                                        onclick="validar_modal({{ $agendamento->id_agendamento }});">
                                        <i class="fa fa-check-circle"></i> Valídar </button>
                                    <button data-toggle="modal" data-target="#invalidar" class="btn btn-secondary btn-sm"
                                        onclick="invalidar_modal({{ $agendamento->id_agendamento }});">
                                        <i class="fa fa-ban"></i> Invalidar </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal validar -->
    <div class="modal modal-danger fade" id="validar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Deseja Validar?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form id="validarForm" action="{{ route('ValidacaoAgendamento.validar') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja validar o agendamento Nº "<span id="info_agendamento_v"></span>"?
                        </p>
                        <input type="hidden" name="id_agendamento" id="id_agendamento_v" value="">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-light">Validar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Invalidar -->
    <div class="modal modal-danger fade" id="invalidar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Deseja Invalidar?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form id="invalidarForm" action="{{ route('ValidacaoAgendamento.invalidar') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja invalidar o agendamento Nº "<span id="info_agendamento_iv"></span>"?
                        </p>
                        <input type="hidden" name="id_agendamento" id="id_agendamento_iv" value="">
                        <div class="form-group text-center">
                            <label for="agendamento_periodo">Selecione o motivo da invalidade:</label>
                            <div class="row align-items-center justify-content-center text-center">
                                <div class="col-md-5">
                                    <select id="agendamento_tipo" name="vm_id"
                                        class="form-control form-control-user text-center" required>
                                        @foreach ($motivos_validacao as $motivo)
                                            <option value="{{ $motivo->id_vm }}"
                                                {{ old('id_vm') == $motivo->id_vm ? 'selected' : '' }}>
                                                {{ $motivo->nome_motivo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-light">Invalidar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/validacao/index.js') }}"></script>
@endsection
