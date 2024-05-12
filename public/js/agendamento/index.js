function marcar_modal(id_agendamento) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('n_id_agendamento').value = id_agendamento;
    document.getElementById('info-agendamento').innerText = id_agendamento;
};

function desmarcar_modal(id_agendamento) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('nn_id_agendamento').value = id_agendamento;
    document.getElementById('iinfo-agendamento').innerText = id_agendamento;
};

function deletar_modal(id_agendamento) {
    // Atualizar o action do formulário com o ID do paciente
    document.getElementById('id_agendamento_n').value = id_agendamento;
    document.getElementById('info-reg').innerText = id_agendamento;
};