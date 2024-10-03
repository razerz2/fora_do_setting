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
    <h1 class="h3 mb-2 text-gray-800">Configuração</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Período para Atendimentos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-dark">
                            <th> Período </th>
                            <th> Horário Inicial </th>
                            <th> Horário Final </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($periodos as $periodo)
                            <tr class="text-center">
                                <td class="text-center"><small>{{ $periodo->periodo }}</small></td>
                                <td class="text-center"><small></small>{{ substr($periodo->hora_inicial, 0, 5) }}hr</td>
                                <td class="text-center"><small></small>{{ substr($periodo->hora_final, 0, 5) }}hr</td>
                                <td align="center">
                                    <a href="{{ route('Periodo.edit', ['periodo' => $periodo->id_ap]) }}"
                                        class="btn btn-secondary btn-sm"> <i class="fa fa-edit"></i> Editar 
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
