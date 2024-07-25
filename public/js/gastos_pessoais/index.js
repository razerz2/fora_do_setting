function deletar_modal(id_rg, nome_usuario) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('id_registro').value = id_rg;
    document.getElementById('info-name').innerText = nome_usuario;
};