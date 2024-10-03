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
    <h1 class="h3 mb-2 text-gray-800">Logs</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Visualizaçãos Logs do Sistema</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-sm table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-dark">
                            <th style="width: 8%"> Nº </th>
                            <th> Usuário </th>
                            <th> Área </th>
                            <th> Ação </th>
                            <th> Data </th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr class="text-center">
                                <td class="text-center"><small>{{ $log->id_logs }}</small></td>
                                <td class="text-center"><small>{{ $log->user->name }}</small></td>
                                <td class="text-center"><small>{{ $log->route }}</small></td>
                                <td class="text-center"><small>{{ $log->action }}</small></td>
                                <td class="text-center"><small>{{ \Carbon\Carbon::parse($log->data_registro)->format('d/m/Y') }}</small></td>
                                <td align="center">
                                    <a href="{{ route('Logs.show', ['log' => $log->id_logs]) }}"
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
