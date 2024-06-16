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
    <h1 class="h3 mb-2 text-gray-800">Sessões</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Sessões Canceladas</h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col md-10">
                    <a class="btn btn-secondary btn-sm" href="{{ route('Sessao.index') }}"> <i class="fas fa-fw fa-regular fa-address-card"></i>
                        Sessões </a>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table id="dataTable" class="table table-sm table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-dark">
                            <th style="width: 8%"> Nº </th>
                            <th> Paciente </th>
                            <th> Valor </th>
                            <th> Dia da Semana </th>
                            <th> Horário </th>
                            <th> Data </th>
                            <th> motivo </th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sessoes as $sessao)
                            <tr class="text-center">
                                <td class="text-center"><small>{{ $sessao->id_sc }}</small></td>
                                <td class="text-center"><small>{{ $sessao->nome_paciente }}</small></td>
                                <td class="text-center"><small><small>R$ {{ number_format($sessao->valor, 2, ',', '.') }}</small></td>
                                <td class="text-center"><small>{{ $sessao->dia }}</small></td>
                                <td class="text-center"><small>{{ substr($sessao->horario_inicial, 0, 5) }} às
                                        {{ substr($sessao->horario_final, 0, 5) }}</small></td>
                                <td class="text-center">
                                    <small>{{ \Carbon\Carbon::parse($sessao->data_sessao)->format('d/m/Y') }}</small>
                                </td>
                                <td class="text-center"><small>{{ $sessao->nome_motivo }}</small></td>
                                <td align="center">
                                    <a href="{{ route('SessaoCancelada.show', ['sessao' => $sessao->id_sc]) }}"
                                        class="btn btn-secondary btn-sm"> <i class="fa fa-eye"></i> Visualizar </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
