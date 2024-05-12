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