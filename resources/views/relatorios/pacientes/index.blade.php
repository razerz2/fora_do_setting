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
            <h6 class="text-center m-0 font-weight-bold text-secondary">Relatórios de Pacientes</h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col md-10">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <ul>
                                <li><a href="{{ route('Relatorios.PacientesAtivos') }}">Pacientes Ativos</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <ul>
                                <li><a href="{{ route('Relatorios.PacientesInativos') }}">Pacientes Inativos</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <ul>
                                <li><a href="{{ route('Relatorios.PacientesAdolescentes') }}">Pacientes Adolescentes</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <ul>
                                <li><a href="{{ route('Relatorios.PacientesAdultos') }}">Pacientes Adultos</a></li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <ul>
                                <li><a href="#" data-toggle="modal" data-target="#modal_paciente_genero">Pacientes por Gênero</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Invalidar -->
    <div class="modal modal-danger fade" id="modal_paciente_genero" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Gerar Relatório?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form id="form_paciente_genero" action="{{ route('Relatorios.PacientesPorGenero') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">
                            Selecione o gênero que deseja para gerar este relatório.
                        </p>
                        <div class="form-group text-center">
                            <label for="list_genero">Selecione o gênero:</label>
                            <div class="row align-items-center justify-content-center text-center">
                                <div class="col-md-5">
                                    <select id="list_genero" name="genero_id"
                                        class="form-control form-control-user text-center" required>
                                        @foreach ($generos as $genero)
                                            <option value="{{ $genero->id_genero }}"
                                                {{ old('id_genero') == $genero->id_genero ? 'selected' : '' }}>
                                                {{ $genero->nome_genero }}
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
@endsection
