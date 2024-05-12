@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pacientes \ <span class="h6 mb-0 text-gray-800"> Informações dos Pacientes </span>
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">

        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <form>
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
                                            <img id="exampleInputImagem"
                                                src="{{ asset('storage/images/pacientes/pct' . $paciente->id_paciente . '.jpg') }}"
                                                style="width: 150px; height: 150px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputNomePaciente">Nome do Paciente:</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputNomePaciente" value="{{ $paciente->nome_paciente }}"
                                        name="nome_paciente" aria-describedby="nameHelp" placeholder="Nome Completo..."
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputRG">RG:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputRG"
                                        value="{{ $paciente->rg }}" name="rg" aria-describedby="rgHelp"
                                        placeholder="Nº de RG..." disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCPF">CPF:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputCPF"
                                        value="{{ $paciente->cpf }}" name="cpf" aria-describedby="cpfHelp"
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
                                                id="exampleInputDataNascimento" value="{{ $paciente->data_nascimento }}"
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
                                            <select id="exampleInputSexo" name="sexo"
                                                class="form-control form-control-user" disabled>
                                                <option selected>{{ $paciente->sexo }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputName">Email:</label>
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        value="{{ $paciente->email }}" name="email" aria-describedby="emailHelp"
                                        placeholder="Digite seu E-mail..." disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputTelefone1">Telefone 1:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputTelefone1"
                                        value="{{ $paciente->telefone_1 }}" name="telefone_1"
                                        aria-describedby="Telefone1Help" placeholder="Digite o nº do seu telefone..."
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputTelefone2">Telefone 2:</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputConfirmedTelefone2" aria-describedby="Telefone2Help"
                                        value="{{ $paciente->telefone_2 }}" name="telefone_2"
                                        placeholder="Digite outro nº de telefone..." disabled>
                                </div>
                            </div>
                        </div>
                        @if ($paciente->resp_tel_1)
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="exampleInputRespTelefone1">Nome do Responsável do telefone:</label>
                                        <input type="text" class="form-control form-control-user"
                                            id="exampleInputRespTelefone1" value="{{ $paciente->resp_tel_1 }}"
                                            name="resp_tel_1" aria-describedby="Telefone1Help"
                                            placeholder="Digite o nome do responsável pelo telefone..." disabled>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="exampleInputRespTelefone2">Nome do responsável do telefone 2:</label>
                                        <input type="text" class="form-control form-control-user"
                                            id="exampleInputRespTelefone2" aria-describedby="Telefone2Help"
                                            value="{{ $paciente->resp_tel_2 }}" name="resp_tel_2"
                                            placeholder="Digite o nome do responsável pelo segundo telefone..." disabled>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($paciente->enderecoP)
                            <hr class="hr" />
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-10">
                                    <div class="d-sm-flex align-items-center justify-content-between md-10">
                                        <h1 class="h5 md-10 text-gray-800">Endereço do Paciente:</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEndereco">Endereço:</label>
                                        <input type="text" class="form-control form-control-user"
                                            id="exampleInputEndereco" value="{{ $paciente->enderecoP->endereco }}"
                                            name="endereco" aria-describedby="EnderecoHelp"
                                            placeholder="Digite o endereço..." disabled>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputNEndereco">Nº do Endereço:</label>
                                        <input type="text" class="form-control form-control-user"
                                            id="exampleInputNEndereco" aria-describedby="NEnderecoHelp"
                                            value="{{ $paciente->enderecoP->n_endereco }}" name="n_endereco"
                                            placeholder="Digite o nº..." disabled>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputComplemento">Complemento:</label>
                                        <input type="text" class="form-control form-control-user"
                                            id="exampleInputComplemente" aria-describedby="ComplementoHelp"
                                            value="{{ $paciente->enderecoP->complemento }}" name="complemento"
                                            placeholder="Digite o complemento do endereço..." disabled>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputCEP">CEP:</label>
                                        <input type="text" class="form-control form-control-user"
                                            id="exampleInputNEndereco" aria-describedby="CEPHelp"
                                            value="{{ $paciente->enderecoP->cep }}" name="cep"
                                            placeholder="Digite o CEP..." disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Pais: </label>
                                        <input type="text" class="form-control form-control-user"
                                            value="{{ $paciente->enderecoP->pais->nome }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Estado: </label>
                                        <input type="text" class="form-control form-control-user"
                                            value="{{ $paciente->enderecoP->estado->nome_estado }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cidade: </label>
                                        <input type="text" class="form-control form-control-user"
                                            value="{{ $paciente->enderecoP->cidade->nome_cidade }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <button  type="button" data-toggle="modal" data-target="#delete-endereco" class="btn btn-danger"><i class="fa fa-trash"></i>
                                            Excluír Endereço</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal modal-danger fade" id="delete-endereco" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h4 class="modal-title text-center" id="myModalLabel">Deseja Excluir?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('PacientesEndereco.destroy', $paciente->id_paciente) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p class="text-center">
                            Tem certeza de que deseja excluír o endereço do paciente '{{$paciente->nome_paciente}}'?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Excluír</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
