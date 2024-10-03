function editar_pais(id_pais, nome_pais, codigo, sigla2, sigla3 ) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('md-editar-span-id_pais').innerText = id_pais;
    document.getElementById('md-editar-id_pais').value = id_pais;
    document.getElementById('md-editar-nome_pais').value = nome_pais;
    document.getElementById('md-editar-codigo_pais').value = codigo;
    document.getElementById('md-editar-sigla2').value = sigla2;
    document.getElementById('md-editar-sigla3').value = sigla3;
    
};

function excluir_pais(id_pais, nome_pais) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('md-excluir-span-id_pais').innerText = id_pais;
    document.getElementById('md-excluir-span-nome_pais').innerText = nome_pais;
    document.getElementById('md-excluir-id_pais').value = id_pais;
};