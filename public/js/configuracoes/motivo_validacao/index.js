function editar_motivo(id_motivo, nome_motivo, descricao ) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('md-editar-span-id_vm').innerText = id_motivo;
    document.getElementById('md-editar-id_vm').value = id_motivo;
    document.getElementById('md-editar-nome_motivo').value = nome_motivo;
    document.getElementById('md-editar-descricao_motivo').value = descricao;
    
};

function excluir_motivo(id_motivo, nome_motivo) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('md-excluir-span-id_vm').innerText = id_motivo;
    document.getElementById('md-excluir-span-nome_motivo').innerText = nome_motivo;
    document.getElementById('md-excluir-id_vm').value = id_motivo;
};