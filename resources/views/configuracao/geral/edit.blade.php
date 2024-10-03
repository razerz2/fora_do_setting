@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Configurações \ <span class="h6 mb-0 text-gray-800"> Geral </span>
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">

        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <form id="userForm" action="{{ route('Configuracoes.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-secondary text-center">Configurações Gerais</h6>
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
                                    <label for="exampleInputImagem">Logo Login:</label>
                                    <div class="text-center">
                                        <div id="imageContainerA" class="rounded">
                                            <img id="exampleInputImagem"
                                                src="{{ asset('storage/' . config('settings.login_logo')) }}" style="width: 200px; height: 200px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Arquivo:</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input id="InputFileA" type="file" class="custom-file-input"
                                                name="login_logo">
                                            <label class="custom-file-label" for="exampleInputFile">Buscar
                                                arquivo...</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="input-group-text" type="button"
                                                id="uploadButtonA">Carregar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputImagem">Logo Geral:</label>
                                    <div class="text-center">
                                        <div id="imageContainerB" class="rounded">
                                            <img id="exampleInputImagem"
                                                src="{{ asset('storage/' . config('settings.system_logo')) }}" style="width: 220px; height: 50px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Arquivo:</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input id="InputFileB" type="file" class="custom-file-input"
                                                name="system_logo">
                                            <label class="custom-file-label" for="exampleInputFile">Buscar
                                                arquivo...</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="input-group-text" type="button"
                                                id="uploadButtonB">Carregar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputNameFull">Nome do Sistema:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputName"
                                        value="{{ old('name', config('settings.project_name')) }}" name="project_name"
                                        aria-describedby="nameFullHelp" placeholder="Nome do Sistema...">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="timezone">Fuso Horário</label>
                                    <select name="timezone" class="form-control">
                                        @foreach (timezone_identifiers_list() as $timezone)
                                            <option value="{{ $timezone }}"
                                                {{ config('settings.timezone') == $timezone ? 'selected' : '' }}>
                                                {{ $timezone }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Card Body -->
                    <div class="card-footer">
                        <div class="row align-items-center justify-content-center text-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <a href="{{ route('Users.index') }}" class="btn btn-secondary btn-sm"><i
                                            class="fas fa-ban"></i> Cancelar</a>
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
    <script>
        document.getElementById('uploadButtonA').addEventListener('click', function() {
            const imageInput = document.getElementById('InputFileA');
            const imageContainer = document.getElementById('imageContainerA');

            if (imageInput.files.length > 0) {
                const file = imageInput.files[0];

                // Verifica se o tipo do arquivo é JPEG (.jpg) ou PNG
                if (file.type === 'image/jpeg' || file.type === 'image/png') {
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
                    alert('Por favor, selecione um arquivo de imagem no formato .jpg ou .png.');
                }
            }
        });

        document.getElementById('uploadButtonB').addEventListener('click', function() {
            const imageInput = document.getElementById('InputFileB');
            const imageContainer = document.getElementById('imageContainerB');

            if (imageInput.files.length > 0) {
                const file = imageInput.files[0];

                if (file.type === 'image/jpeg' || file.type === 'image/png') { // Verifica se o tipo do arquivo é JPEG ou PNG
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
                    alert('Por favor, selecione um arquivo de imagem no formato .jpg ou .png.');
                }
            }
        });

        document.getElementById('userForm').addEventListener('submit', function(event) {
            const imageInputA = document.getElementById('InputFileA');
            const imageInputB = document.getElementById('InputFileB');
            if (imageInputA.files.length > 0) {
                const file = imageInputA.files[0];
                if (file.type !== 'image/jpeg' && file.type !== 'image/png') {
                    event.preventDefault(); // Impede o envio do formulário
                    alert('Por favor, selecione um arquivo de imagem no formato .jpg ou .png.');
                }
            }

            if (imageInputB.files.length > 0) {
                const file = imageInputB.files[0];
                if (file.type !== 'image/jpeg' && file.type !== 'image/png') {
                    event.preventDefault(); // Impede o envio do formulário
                    alert('Por favor, selecione um arquivo de imagem no formato .jpg ou .png.');
                }
            }
        });
    </script>
@endsection
