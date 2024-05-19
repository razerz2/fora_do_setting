function validar_modal(id_agendamento) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('id_agendamento_v').value = id_agendamento;
    document.getElementById('info_agendamento_v').innerText = id_agendamento;
};

function invalidar_modal(id_agendamento) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('id_agendamento_iv').value = id_agendamento;
    document.getElementById('info_agendamento_iv').innerText = id_agendamento;
};