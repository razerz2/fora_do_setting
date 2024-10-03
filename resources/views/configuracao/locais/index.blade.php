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
    <h1 class="h3 mb-2 text-gray-800">Locais</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Locais do Sistema</h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col md-10">
                    <ul class="list-group list-group-flush">
                        
                        <li class="list-group-item">
                            <ul>
                                <li><a href="{{ route('LocaisPaises.index') }}">Paises</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <ul>
                                <li><a href="{{ route('LocaisEstados.index') }}">Estados</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <ul>
                                <li><a href="{{ route('LocaisCidades.index') }}">Cidades</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
