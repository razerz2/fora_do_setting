function editar_motivo(id_motivo, nome_motivo, descricao ) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('md-editar-span-id_mi').innerText = id_motivo;
    document.getElementById('md-editar-id_mi').value = id_motivo;
    document.getElementById('md-editar-nome_mi').value = nome_motivo;
    document.getElementById('md-editar-descricao').value = descricao;
    
};

function excluir_motivo(id_motivo, nome_motivo) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('md-excluir-span-id_mi').innerText = id_motivo;
    document.getElementById('md-excluir-span-nome_mi').innerText = nome_motivo;
    document.getElementById('md-excluir-id_mi').value = id_motivo;
};