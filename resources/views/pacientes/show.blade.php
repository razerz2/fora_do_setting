@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pacientes \ <span class="h6 mb-0 text-gray-800"> Informações dos Pacientes </span></h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">

        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <form>
                    @csrf
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-secondary text-center">Informações do Paciente</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputImagem">Foto do Paciente:</label>
                                    <div class="text-center">
                                        <div id="imageContainer" class="rounded" style="width: 150px; height: 150px;">
                                            <img id="exampleInputImagem" src="{{ asset('storage/images/pacientes/pct' . $paciente->id_paciente . '.jpg') }}"
                                                style="width: 150px; height: 150px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputNomePaciente">Nome do Paciente:</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputNomePaciente" value="{{$paciente->nome_paciente}}"
                                        name="nome_paciente" aria-describedby="nameHelp" placeholder="Nome Completo..." disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputRG">RG:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputRG"
                                        value="{{$paciente->rg}}" name="rg" aria-describedby="rgHelp"
                                        placeholder="Nº de RG..." disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCPF">CPF:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputCPF"
                                        value="{{$paciente->cpf}}" name="cpf" aria-describedby="cpfHelp"
                                        placeholder="Nº de CPF..." disabled>
                                </div>

                            </div>
                        </div>

                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputDataNascimento">Data de Nascimento:</label>
                                            <input type="date" class="form-control form-control-user"
                                                id="exampleInputDataNascimento" value="{{$paciente->data_nascimento}}"
                                                name="data_nascimento" aria-describedby="emailDataNascimento"
                                                placeholder="Informe sua data de nascimento..." disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputIdade">idade:</label>
                                            <input id="inputIdade"type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" value="{{ $paciente->idade }}" name="idade"
                                                aria-describedby="idadeHelp" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputSexo">Sexo:</label>
                                            <select id="exampleInputSexo" name="sexo" class="form-control form-control-user" disabled>
                                                <option selected>{{$paciente->sexo}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputName">Email:</label>
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        value="{{$paciente->email}}" name="email" aria-describedby="emailHelp"
                                        placeholder="Digite seu E-mail..." disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputTelefone1">Telefone 1:</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputTelefone1" value="{{$paciente->telefone_1}}" name="telefone_1"
                                        aria-describedby="Telefone1Help" placeholder="Digite o nº do seu telefone..." disabled>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputTelefone2">Telefone 2:</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputConfirmedTelefone2" aria-describedby="Telefone2Help"
                                        value="{{$paciente->telefone_2}}" name="telefone_2"
                                        placeholder="Digite outro nº de telefone..." disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
