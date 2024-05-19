function marcar_modal(id_agendamento) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('id_agendamento_m').value = id_agendamento;
    document.getElementById('info-agendamento_m').innerText = id_agendamento;
};

function desmarcar_modal(id_agendamento) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('id_agendamento_d').value = id_agendamento;
    document.getElementById('info-agendamento_d').innerText = id_agendamento;
};

function reagendar_modal(id_agendamento) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('id_agendamento_r').value = id_agendamento;
    document.getElementById('info-agendamento_r').innerText = id_agendamento;
};

function deletar_modal(id_agendamento) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('id_agendamento_ex').value = id_agendamento;
    document.getElementById('info-agendamento_ex').innerText = id_agendamento;
};