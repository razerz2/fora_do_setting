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

let allChecked = false;  // Variável para rastrear o estado atual dos checkboxes

function toggleCheckboxes() {
    const form = document.getElementById('formSeletedCheck');
    if (form) {
        const checkboxes = form.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            // Define o estado dos checkboxes de acordo com o valor de allChecked
            checkbox.checked = !allChecked;
        });
        // Alterna o valor de allChecked
        allChecked = !allChecked;
    }
}

document.getElementById('formSeletedCheck').addEventListener('submit', function(event) {
    const form = event.target;
    const checkboxes = form.querySelectorAll('input[type="checkbox"]');
    let isChecked = false;

    // Verifica se pelo menos um checkbox está selecionado
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            isChecked = true;
        }
    });

    if (!isChecked) {
        // Se nenhum checkbox estiver selecionado, exibe o alerta e previne o envio do formulário
        alert('Selecione pelo menos um agendamento para validação');
        event.preventDefault();
    }
});