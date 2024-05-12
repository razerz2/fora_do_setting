@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pacientes \ <span class="h6 mb-0 text-gray-800"> Desativar Pacientes </span></h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">

        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <form id="userForm" action="{{ route('Pacientes.desativar') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-secondary text-center">Desativar Paciente</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputImagem">Foto do Paciente:</label>
                                    <div class="text-center">
                                        <div id="imageContainer" class="rounded" style="width: 150px; height: 150px;">
                                            <img id="exampleInputImagem"
                                                src="{{ asset('storage/images/pacientes/pct' . $paciente->id_paciente . '.jpg') }}"
                                                style="width: 150px; height: 150px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="hidden" name="paciente_id"
                                        value="{{ old('id_paciente', $paciente->id_paciente) }}">
                                    <label for="exampleInputNomePaciente">Nome do Paciente:</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputNomePaciente"
                                        value="{{ old('nome_paciente', $paciente->nome_paciente) }}"
                                        aria-describedby="nameHelp" placeholder="Nome Completo..." disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputRG">RG:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputRG"
                                        value="{{ old('rg', $paciente->rg) }}" aria-describedby="rgHelp"
                                        placeholder="Nº de RG..." disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCPF">CPF:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputCPF"
                                        value="{{ old('cpf', $paciente->cpf) }}" aria-describedby="cpfHelp"
                                        placeholder="Nº de CPF..." disabled>
                                </div>

                            </div>
                        </div>

                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputStatus">Status:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputStatus"
                                        value="Inativo" name="status" aria-describedby="StatusHelp" disabled>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputMotivoInativacao">Motivo da Inativação:</label>
                                    <select id="exampleInputMotivoInativacao" name="mi_id"
                                        class="form-control form-control-user" required>
                                        @foreach ($motivos as $motivo)
                                            <option value="{{ $motivo->id_mi }}">{{ $motivo->nome_mi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- Card Body -->
            <div class="card-footer">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-md-10">
                        <div class="form-group">
                            <a href="{{ route('Pacientes.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-ban"></i>
                                Cancelar</a>
                            <button type="submit" class="btn btn-dark btn-sm"><i class="fas fa-save"></i>
                                Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
