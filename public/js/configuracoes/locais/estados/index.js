function editar_estado(id_estado, nome_estado, uf, pais_id, nome_pais ) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('md-editar-span-id_estado').innerText = id_estado;
    document.getElementById('md-editar-pais_id').value = pais_id;
    document.getElementById('md-editar-nome_pais').value = nome_pais;
    document.getElementById('md-editar-id_estado').value = id_estado;
    document.getElementById('md-editar-nome_estado').value = nome_estado;
    document.getElementById('md-editar-uf').value = uf;
    
    
};

function excluir_estado(id_estado, nome_estado) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('md-excluir-span-id_estado').innerText = id_estado;
    document.getElementById('md-excluir-span-nome_estado').innerText = nome_estado;
    document.getElementById('md-excluir-id_estado').value = id_estado;
};