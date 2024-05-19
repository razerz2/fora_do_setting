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
    <h1 class="h3 mb-2 text-gray-800">Agenda</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Agendamentos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-sm table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-dark">
                            <th style="width: 8%"> Nº </th>
                            <th> Tipo </th>
                            <th> Dia da Semana </th>
                            <th> Período </th>
                            <th> Horário </th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agendamentos as $agendamento)
                            <tr class="text-center">
                                <td class="text-center"><small>{{ $agendamento->id_agendamento }}</small></td>
                                <td class="text-center"><small>{{ $agendamento->agendamentoTipo->tipo_agendamento }}</small>
                                </td>
                                <td class="text-center"><small>{{ $agendamento->dia }}</small></td>
                                <td class="text-center"><small>{{ $agendamento->agendamentoPeriodo->periodo }}</small></td>
                                <td class="text-center"><small>{{ substr($agendamento->horario_inicial, 0, 5) }} às
                                        {{ substr($agendamento->horario_final, 0, 5) }}</small></td>
                                <td align="center">
                                    @if ($agendamento->at_id == 2)
                                        <button data-toggle="modal" data-target="#marcar" class="btn btn-secondary btn-sm"
                                            onclick="marcar_modal({{ $agendamento->id_agendamento }});">
                                            <i class="fa fa-arrow-alt-circle-up"></i> Marcar </button>
                                    @elseif ($agendamento->at_id != 2)
                                        <button data-toggle="modal" data-target="#desmarcar"
                                            class="btn btn-secondary btn-sm"
                                            onclick="desmarcar_modal({{ $agendamento->id_agendamento }});">
                                            <i class="fa fa-arrow-alt-circle-down"></i> Desmarcar </button>
                                        <button data-toggle="modal" data-target="#reagendar"
                                            class="btn btn-secondary btn-sm"
                                            onclick="reagendar_modal({{ $agendamento->id_agendamento }});">
                                            <i class="fa fa-pen-square"></i> Reagendar </button>
                                    @endif
                                    <a href="{{ route('Agendamento.show', ['agendamento' => $agendamento->id_agendamento]) }}"
                                        class="btn btn-secondary btn-sm"> <i class="fa fa-eye"></i> Visualizar </a>
                                    <button data-toggle="modal" data-target="#delete" class="btn btn-secondary btn-sm"
                                        onclick="deletar_modal({{ $agendamento->id_agendamento }}, '{{ $agendamento->at_id }}');">
                                        <i class="fa fa-trash"></i> Excluir </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Marcar -->
    <div class="modal modal-danger fade" id="marcar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Deseja Marcar?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form id="marcarForm" action="{{ route('Agendamento.redirecionador') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja marcar no horário Nº "<span id="info-agendamento_m"></span>"?
                        </p>
                        <input type="hidden" name="id_agendamento" id="id_agendamento_m" value="">
                        <div class="form-group text-center">
                            <label for="agendamento_periodo">Selecione o tipo de agendamento:</label>
                            <div class="row align-items-center justify-content-center text-center">
                                <div class="col-md-5">
                                    <select id="agendamento_tipo" name="at_id"
                                        class="form-control form-control-user text-center" required>
                                        @foreach ($tipo_agendamentos as $tipo_agendamento)
                                            <option value="{{ $tipo_agendamento->id_at }}"
                                                {{ old('at_id') == $tipo_agendamento->id_at ? 'selected' : '' }}>
                                                {{ $tipo_agendamento->tipo_agendamento }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-light">Marcar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Desmarcar -->
    <div class="modal modal-danger fade" id="desmarcar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Deseja desmarcar?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form id="desmarcarForm" action="{{ route('Agendamento.desmarcar') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja desmarcar agendamento Nº "<span id="info-agendamento_d"></span>"?
                        </p>
                        <input type="hidden" name="id_agendamento" id="id_agendamento_d" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-light">Desmarcar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Reagendar -->
    <div class="modal modal-danger fade" id="reagendar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Deseja reagendar?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('Agendamento.reagendar') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja reagendar agendamento Nº "<span id="info-agendamento_r"></span>"?
                        </p>
                        <input type="hidden" name="id_agendamento" id="id_agendamento_r" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-light">Reagendar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Excluír -->
    <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Deseja Excluír?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form id="desativarForm" action="{{ route('Agendamento.excluir') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja excluír o horário Nº "<span id="info-agendamento_ex"></span>"?
                        </p>
                        <input type="hidden" name="id_agendamento" id="id_agendamento_ex" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Excluír</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/agendamento/index.js') }}"></script>
@endsection
