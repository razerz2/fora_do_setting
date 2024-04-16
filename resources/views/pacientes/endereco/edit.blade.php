@extends('layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pacientes \ <span class="h6 mb-0 text-gray-800"> Editar endereço do Paciente </span></h1>
    </div>

    <!-- Content Row -->
    <div class="row align-items-center justify-content-center">

        <!-- Formulario -->
        <div class="col-xl-10 col-lg-8">
            <div class="card shadow mb-4">
                <form id="userForm" action="{{ route('PacientesEndereco.update', ['PacientesEndereco' => $paciente->enderecoP->id_ep]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-secondary text-center">Endereço do Paciente</h6>
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
                                            <img id="exampleInputImagem" src="{{ asset('storage/images/pacientes/pct' . $paciente->id_paciente . '.jpg') }}"
                                                style="width: 150px; height: 150px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputNomePaciente">Nome do Paciente:</label>
                                    <input type="text" name="paciente_id" value="{{$paciente->id_paciente}}" hidden>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputNomePaciente" value="{{$paciente->nome_paciente}}"
                                        name="nome_paciente" aria-describedby="nameHelp" placeholder="Nome Completo..." disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCPF">CPF:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputCPF"
                                        value="{{$paciente->cpf}}" name="cpf" aria-describedby="cpfHelp"
                                        placeholder="Nº de CPF..." disabled>
                                </div>
                            </div>
                        </div>
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
                                    <input type="text" class="form-control form-control-user" id="exampleInputEndereco"
                                        value="{{ old('endereco', $paciente->enderecoP->endereco) }}" name="endereco" aria-describedby="EnderecoHelp"
                                        placeholder="Digite o endereço..." required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputNEndereco">Nº do Endereço:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputNEndereco"
                                        aria-describedby="NEnderecoHelp" value="{{ old('n_endereco', $paciente->enderecoP->n_endereco) }}" name="n_endereco"
                                        placeholder="Digite o nº..." required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputComplemento">Complemento:</label>
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputComplemente" aria-describedby="ComplementoHelp"
                                        value="{{ old('complemento', $paciente->enderecoP->complemento) }}" name="complemento"
                                        placeholder="Digite o complemento do endereço...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputCEP">CEP:</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputNEndereco"
                                        aria-describedby="CEPHelp" value="{{ old('cep', $paciente->enderecoP->cep) }}" name="cep"
                                        placeholder="Digite o CEP..." required>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="paisSelect">Paises:</label>
                                    <select id="paisSelect" name="pais_id" class="form-control form-control-user"
                                        onchange="handlePaisChange()" required>
                                        <option value="">Selecione um país</option> <!-- Opção padrão vazia -->
                                        @foreach($paises as $pais)
                                            <option value="{{ $pais->id_pais }}" {{ $paciente->enderecoP && $paciente->enderecoP->pais_id == $pais->id_pais ? 'selected' : '' }}> 
                                                {{ $pais->nome }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="stateSelect">Estado:</label>
                                    <select id="stateSelect" name="estado_id" class="form-control form-control-user"
                                        onchange="handleStateChange()" required>
                                        <option value="{{ $paciente->enderecoP->estado->id_estado}}" selected>
                                            {{$paciente->enderecoP->estado->nome_estado}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="citySelect">Cidade:</label>
                                    <select id="citySelect" name="cidade_id" class="form-control form-control-user"
                                        required>
                                        <option value="{{ $paciente->enderecoP->cidade->id_cidade}}" selected> 
                                            {{$paciente->enderecoP->cidade->nome_cidade}}
                                        </option>
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
        
        // Lista os paises no seletor de país
        function listarPaises() {
            var baseUrl = '{{ url('/') }}';
            // Faça a chamada AJAX para obter as cidades do estado selecionado
            $.ajax({
                url: baseUrl + '/getPaises/',
                type: 'GET',
                success: function(response) {
                    var paises = response;

                    // Limpe as opções atuais
                    $('#paisSelect').empty();

                    // Adicione as novas opções de cidade
                    $.each(paises, function(key, value) {
                        $('#paisSelect').append('<option value="' + value.id_pais + '">' +
                            value.nome + '</option>');
                    });
                    listarEstados();
                    listarCidades();
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao obter os paises:', error);
                    console.log('Status:', status);
                    console.log('XHR:', xhr);
                }
            });
        }

        // Lista os estadps no seletor de estados
        function listarEstados() {
            var paisSelect = document.getElementById('paisSelect');
            // Obtém o valor do primeiro elemento option
            var paisId = paisSelect.options[0].value;
            var baseUrl = '{{ url('/') }}';
            // Faça a chamada AJAX para obter as cidades do estado selecionado
            $.ajax({
                url: baseUrl + '/getEstados/' + paisId,
                type: 'GET',
                success: function(response) {
                    var states = response;

                    // Limpe as opções atuais
                    $('#stateSelect').empty();

                    // Adicione as novas opções de cidade
                    $.each(states, function(key, value) {
                        $('#stateSelect').append('<option value="' + value.id_estado + '">' +
                            value.nome_estado + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao obter as estados:', error);
                    console.log('Status:', status);
                    console.log('XHR:', xhr);
                }
            });
        }

        // Lista as cidades no seletor de cidades
        function listarCidades() {
            var stateSelect = document.getElementById('stateSelect');
            // Obtém o valor do primeiro elemento option
            var stateId = stateSelect.options[0].value;
            var baseUrl = '{{ url('/') }}';
            // Faça a chamada AJAX para obter as cidades do estado selecionado
            $.ajax({
                url: baseUrl + '/getCidades/' + stateId,
                type: 'GET',
                success: function(response) {
                    var states = response;

                    // Limpe as opções atuais
                    $('#citySelect').empty();

                    // Adicione as novas opções de cidade
                    $.each(states, function(key, value) {
                        $('#citySelect').append('<option value="' + value.id_cidade + '">' +
                            value.nome_cidade + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao obter as cidades:', error);
                    console.log('Status:', status);
                    console.log('XHR:', xhr);
                }
            });
        }

        //Limpa a select Cidade
        function limparSelects() {
            $('#citySelect').empty();
        }

        // Lista os paises no seletor de país ao realizar ação
        function handlePaisChange() {
            var paisId = document.getElementById('paisSelect').value; // Obtém o valor selecionado

            var baseUrl = '{{ url('/') }}';
            // Faça a chamada AJAX para obter as cidades do estado selecionado
            $.ajax({
                url: baseUrl + '/getEstados/' + paisId,
                type: 'GET',
                success: function(response) {
                    var states = response;

                    // Limpe as opções atuais
                    $('#stateSelect').empty();

                    // Adicione as novas opções de cidade
                    $.each(states, function(key, value) {
                        $('#stateSelect').append('<option value="' + value.id_estado + '">' +
                            value.nome_estado + '</option>');
                    });

                    limparSelects();
                    listarCidades();
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao obter os estados:', error);
                    console.log('Status:', status);
                    console.log('XHR:', xhr);
                }
            });

        }

        // Lista os estados no seletor de estado ao realizar ação
        function handleStateChange() {
            var stateId = document.getElementById('stateSelect').value; // Obtém o valor selecionado
            var baseUrl = '{{ url('/') }}';
            // Faça a chamada AJAX para obter as cidades do estado selecionado
            $.ajax({
                url: baseUrl + '/getCidades/' + stateId,
                type: 'GET',
                success: function(response) {
                    var states = response;

                    // Limpe as opções atuais
                    $('#citySelect').empty();

                    // Adicione as novas opções de cidade
                    $.each(states, function(key, value) {
                        $('#citySelect').append('<option value="' + value.id_cidade + '">' +
                            value.nome_cidade + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao obter as cdadess:', error);
                    console.log('Status:', status);
                    console.log('XHR:', xhr);
                }
            });
        }
    </script>
@endsection
