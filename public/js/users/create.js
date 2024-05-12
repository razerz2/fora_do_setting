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