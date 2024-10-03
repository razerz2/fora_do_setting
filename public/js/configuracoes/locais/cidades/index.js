function editar_cidade(id_cidade, nome_cidade, id_estado, id_pais) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('md-edit-span-id_cidade').innerText = id_cidade;
    document.getElementById('md-edit-id_cidade').value = id_cidade;
    document.getElementById('md-edit-nome_cidade').value = nome_cidade;

    listarPaises(id_pais, id_estado);
};

function excluir_cidade(id_cidade, nome_cidade) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('md-excluir-span-id_cidade').innerText = id_cidade;
    document.getElementById('md-excluir-span-nome_cidade').innerText = nome_cidade;
    document.getElementById('md-excluir-id_cidade').value = id_cidade;
};

// Lista os paises no seletor de país ao realizar ação
function handlePaisChange() {
    var paisId = document.getElementById('paisSelect').value; // Obtém o valor selecionado

    var baseUrl = window.location.protocol + '//' + window.location.hostname + (window.location.port ? ':' + window
        .location.port : '');
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
            console.error('Erro ao obter os estados:', error);
            console.log('Status:', status);
            console.log('XHR:', xhr);
        }
    });
}

// Lista os paises no seletor de país ao realizar ação em editar
function EditHandlePaisChange() {
    var paisId = document.getElementById('md-edit-paisSelect').value; // Obtém o valor selecionado

    var baseUrl = window.location.protocol + '//' + window.location.hostname + (window.location.port ? ':' + window
        .location.port : '');
    // Faça a chamada AJAX para obter as cidades do estado selecionado
    $.ajax({
        url: baseUrl + '/getEstados/' + paisId,
        type: 'GET',
        success: function(response) {
            var states = response;

            // Limpe as opções atuais
            $('#md-edit-stateSelect').empty();

            // Adicione as novas opções de cidade
            $.each(states, function(key, value) {
                $('#md-edit-stateSelect').append('<option value="' + value.id_estado + '">' +
                    value.nome_estado + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Erro ao obter os estados:', error);
            console.log('Status:', status);
            console.log('XHR:', xhr);
        }
    });
}

// Lista os paises no seletor de país
function listarPaises(id_pais, id_estado) {
    var baseUrl = window.location.protocol + '//' + window.location.hostname + (window.location.port ? ':' + window
        .location.port : '');
    // Faça a chamada AJAX para obter os países
    $.ajax({
        url: baseUrl + '/getPaises/',
        type: 'GET',
        success: function(response) {
            var paises = response;

            // Limpe as opções atuais
            $('#md-edit-paisSelect').empty();

            // Adicione as novas opções de país
            $.each(paises, function(key, value) {
                $('#md-edit-paisSelect').append('<option value="' + value.id_pais + '">' +
                    value.nome + '</option>');
            });

            // Seleciona o país com base na variável id_pais
            if (id_pais) {
                $('#md-edit-paisSelect').val(id_pais);
            }

            // Chama a função listarEstados passando o id_pais e id_estado
            listarEstados(id_pais, id_estado);
        },
        error: function(xhr, status, error) {
            console.error('Erro ao obter os paises:', error);
            console.log('Status:', status);
            console.log('XHR:', xhr);
        }
    });
}

// Lista os estadps no seletor de estados
function listarEstados(id_pais, id_estado) {
    var paisSelect = document.getElementById('paisSelect');
    // Obtém o valor do primeiro elemento option
    var baseUrl = window.location.protocol + '//' + window.location.hostname + (window.location.port ? ':' + window
        .location.port : '');
    // Faça a chamada AJAX para obter as cidades do estado selecionado
    $.ajax({
        url: baseUrl + '/getEstados/' + id_pais,
        type: 'GET',
        success: function(response) {
            var states = response;

            // Limpe as opções atuais
            $('#md-edit-stateSelect').empty();

            // Adicione as novas opções de cidade
            $.each(states, function(key, value) {
                $('#md-edit-stateSelect').append('<option value="' + value.id_estado + '">' +
                    value.nome_estado + '</option>');
            });

            // Seleciona o país com base na variável id_pais
            if (id_estado) {
                $('#md-edit-stateSelect').val(id_estado);
            }
        },
        error: function(xhr, status, error) {
            console.error('Erro ao obter as estados:', error);
            console.log('Status:', status);
            console.log('XHR:', xhr);
        }
    });
}

