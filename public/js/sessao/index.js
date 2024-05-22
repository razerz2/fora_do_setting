function deletar_modal(id_sessao, nome_paciente) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('id_sessao').value = id_sessao;
    document.getElementById('info-sessao-n').innerText = id_sessao;
    document.getElementById('info-sessao').innerText = nome_paciente;
};