
function deletar_modal(id_usuario, nome_usuario) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('desativarForm').action = "/Pacientes/disable/" + id_usuario;
    document.getElementById('id_usuario').value = id_usuario;
    document.getElementById('info-name').innerText = nome_usuario;
};

function ativar_modal(id_usuario, nome_usuario) {
    document.getElementById('id_usuario_at').value = id_usuario;
    document.getElementById('info-name-at').innerText = nome_usuario;
};