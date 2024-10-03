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
    <h1 class="h3 mb-2 text-gray-800">Configurações</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="text-center m-0 font-weight-bold text-secondary">Configurações do Sistema</h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col md-10">
                    <ul class="list-group list-group-flush">
                        
                        <li class="list-group-item">
                            <ul>
                                <li><a href="{{ route('Configuracoes.indexConfig') }}">Geral</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <ul>
                                <li><a href="{{ route('Periodo.index') }}">Período para Atendimentos</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <ul>
                                <li><a href="{{ route('MotivoInativacao.index') }}">Motivos para Inativação</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <ul>
                                <li><a href="{{ route('MotivoValidacoes.index') }}">Motivos para Validações</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <ul>
                                <li><a href="{{ route('PacienteGenero.index') }}">Gênero dos Pacientes</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <ul>
                                <li><a href="{{ route('Locais.index') }}">Locais (País, Estado e Cidade)</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
