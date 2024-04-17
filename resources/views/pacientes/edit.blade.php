@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pacientes \ <span class="h6 mb-0 text-gray-800"> Editar Pacientes </span></h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">

        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <form id="userForm" action="{{ route('Pacientes.update', ['Paciente' => $paciente->id_paciente]) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-secondary text-center">Editar Paciente</h6>
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
                                <div class="form-group">
                                    <label for="exampleInputFile">Arquivo:</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input id="InputFile" type="file" class="custom-file-input" name="InputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Buscar
                                                arquivo...</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="input-group-text" type="button"
                                                id="uploadButton">Carregar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-check">
                                    <input id="CheckResp" class="form-check-input" type="checkbox"
                                        onchange="exibeFormResp()" @if ($paciente->resp_tel_1) checked @endif>
                                    <label class="form-check-label" for="CheckResp">
                                        Responsável
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputNomePaciente">Nome do Paciente:</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputNomePaciente"
                                        value="{{ old('nome_paciente', $paciente->nome_paciente) }}" name="nome_paciente"
                                        aria-describedby="nameHelp" placeholder="Nome Completo..." required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputRG">RG:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputRG"
                                        value="{{ old('rg', $paciente->rg) }}" name="rg" aria-describedby="rgHelp"
                                        placeholder="Nº de RG..." required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCPF">CPF:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputCPF"
                                        value="{{ old('cpf', $paciente->cpf) }}" name="cpf" aria-describedby="cpfHelp"
                                        placeholder="Nº de CPF..." required>
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
                                                id="exampleInputDataNascimento"
                                                value="{{ old('data_nascimento', $paciente->data_nascimento) }}"
                                                name="data_nascimento" aria-describedby="emailDataNascimento"
                                                placeholder="Informe sua data de nascimento..." required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputIdade">idade:</label>
                                            <input id="inputIdade"type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" value="{{ old('idade', $paciente->idade) }}"
                                                name="idade" aria-describedby="idadeHelp" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputSexo">Sexo:</label>
                                            <select id="exampleInputSexo" name="sexo"
                                                class="form-control form-control-user" required>
                                                <option value="F" {{ $paciente->sexo === 'F' ? 'selected' : '' }}>
                                                    Feminino</option>
                                                <option value="M" {{ $paciente->sexo === 'M' ? 'selected' : '' }}>
                                                    Masculino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputName">Email:</label>
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        value="{{ old('email', $paciente->email) }}" name="email"
                                        aria-describedby="emailHelp" placeholder="Digite seu E-mail..." required>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputTelefone1">Telefone 1:</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputTelefone1" value="{{ old('telefone_1', $paciente->telefone_1) }}"
                                        name="telefone_1" aria-describedby="Telefone1Help"
                                        placeholder="Digite o nº do seu telefone..." required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputTelefone2">Telefone 2:</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputConfirmedTelefone2" aria-describedby="Telefone2Help"
                                        value="{{ old('telefone_2', $paciente->telefone_2) }}" name="telefone_2"
                                        placeholder="Digite outro nº de telefone...">
                                </div>
                            </div>
                        </div>
                        <div id="formResp" class="row align-items-center justify-content-center" @if (!$paciente->resp_tel_1) hidden @endif>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputRespTelefone1">Nome do Responsável do telefone:</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputRespTelefone1" value="{{ old('resp_tel_1', $paciente->resp_tel_1) }}"
                                        name="resp_tel_1" aria-describedby="Telefone1Help"
                                        placeholder="Digite o nome do responsável pelo telefone...">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputRespTelefone2">Nome do responsável do telefone 2:</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputRespTelefone2" aria-describedby="Telefone2Help"
                                        value="{{ old('resp_tel_2', $paciente->resp_tel_2) }}" name="resp_tel_2"
                                        placeholder="Digite o nome do responsável pelo segundo telefone...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-footer">
                        <div class="row align-items-center justify-content-center text-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <a href="{{ route('home') }}" class="btn btn-secondary btn-sm"><i
                                            class="fas fa-ban"></i>
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
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('uploadButton').addEventListener('click', function() {
            const imageInput = document.getElementById('InputFile');
            const imageContainer = document.getElementById('imageContainer');

            if (imageInput.files.length > 0) {
                const file = imageInput.files[0];

                if (file.type === 'image/jpeg') { // Verifica se o tipo do arquivo é JPEG (.jpg)
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = new Image();
                        img.src = e.target.result;
                        img.style.maxWidth = '150px'; // Defina o tamanho máximo da imagem
                        img.style.maxHeight = '150px'; // Defina o tamanho máximo da imagem
                        imageContainer.innerHTML = ''; // Limpa qualquer imagem anterior
                        imageContainer.appendChild(img);
                    };

                    reader.readAsDataURL(file);
                } else {
                    alert('Por favor, selecione um arquivo de imagem no formato .jpg.');
                }
            }
        });

        document.getElementById('userForm').addEventListener('submit', function(event) {
            const imageInput = document.getElementById('InputFile');
            if (imageInput.files.length > 0) {
                const file = imageInput.files[0];
                if (file.type !== 'image/jpeg') {
                    event.preventDefault(); // Impede o envio do formulário
                    alert('Por favor, selecione um arquivo de imagem no formato .jpg.');
                }
            }
        });

        function exibeFormResp() {
            var checkbox = document.getElementById('CheckResp');
            var div = document.getElementById('formResp');

            if (checkbox.checked) {
                div.removeAttribute('hidden'); // Remove o atributo hidden para mostrar a div
            } else {
                div.setAttribute('hidden', true); // Adiciona o atributo hidden para ocultar a div
            }
        }

        //Calcula idade...
        function calcularIdade() {
            // Obtém o elemento input de data de nascimento
            var inputDataNascimento = document.getElementById('exampleInputDataNascimento');

            // Obtém o elemento input de idade
            var inputIdade = document.getElementById('inputIdade');

            // Obtém a data de nascimento do valor do input
            var dataNascimento = new Date(inputDataNascimento.value);

            // Calcula a idade a partir da data de nascimento
            var hoje = new Date();
            var idade = hoje.getFullYear() - dataNascimento.getFullYear();
            var mes = hoje.getMonth() - dataNascimento.getMonth();
            if (mes < 0 || (mes === 0 && hoje.getDate() < dataNascimento.getDate())) {
                idade--;
            }

            // Define o valor da idade no input de idade
            inputIdade.value = idade;
        }
    </script>
@endsection
