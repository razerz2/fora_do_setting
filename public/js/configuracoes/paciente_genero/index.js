function editar_genero(id_genero, nome_genero, abreviatura ) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('md-editar-span-id_genero').innerText = id_genero;
    document.getElementById('md-editar-id_genero').value = id_genero;
    document.getElementById('md-editar-nome_genero').value = nome_genero;
    document.getElementById('md-editar-abreviatura').value = abreviatura;
    
};

function excluir_genero(id_genero, nome_genero) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('md-excluir-span-id_genero').innerText = id_genero;
    document.getElementById('md-excluir-span-nome_genero').innerText = nome_genero;
    document.getElementById('md-excluir-id_genero').value = id_genero;
};