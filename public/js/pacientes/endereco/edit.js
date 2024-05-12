// Lista os paises no seletor de país
function listarPaises() {
    var baseUrl = window.location.protocol + '//' + window.location.hostname + (window.location.port ? ':' + window
        .location.port : '');
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
    var baseUrl = window.location.protocol + '//' + window.location.hostname + (window.location.port ? ':' + window
        .location.port : '');
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
    var baseUrl = window.location.protocol + '//' + window.location.hostname + (window.location.port ? ':' + window
        .location.port : '');
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