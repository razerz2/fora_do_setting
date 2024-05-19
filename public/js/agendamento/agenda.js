function carregarDetalhesAgendamento(id) {
    var baseUrl = '{{ url('/') }}';
    $.ajax({
        url: '/getAgendamento/' + id, // URL para sua rota Laravel
        type: 'GET',
        success: function(response) {
            var agendamento = response.data.agendamento;
            var agendamentoDetalhes = response.data.agendamento_detalhes;

            // Construa o conteúdo HTML com os resultados
            var html = '';

            if (agendamento.at_id == 1 && agendamentoDetalhes.length > 0) {
                html += '<p>Paciente: ' + agendamentoDetalhes[0].nome_paciente + '</p>';
            } else if (agendamento.at_id == 3 && agendamentoDetalhes.length > 0) {
                html += '<p>Descrição: ' + agendamentoDetalhes[0].descricao + '</p>';
            } else {
                html += '<p> Nenhum horário marcado </p>';
            }

            html += '<p>Dia da Semana: ' + agendamento.dia + '</p>' +
                '<p>Período: ' + agendamento.agendamento_periodo.periodo + '</p>' +
                '<p>Horário Inicial: ' + formatarHorario(agendamento.horario_inicial) + 'hrs </p>' +
                '<p>Horário Final: ' + formatarHorario(agendamento.horario_final) + 'hrs </p>';
                
            if( agendamento.at_id == 1 && agendamentoDetalhes.length > 0)  {
                html += '<p>Modalidade: ' + (agendamentoDetalhes[0].presencial ? 'Presencial' : 'Online') + '</p>';
            }else if(agendamento.at_id == 3 && agendamentoDetalhes.length > 0){
                html += '<p>Modalidade: ' + (agendamentoDetalhes[0].presencial ? 'Presencial' : 'Online') + '</p>';
            }
            // Insira o HTML na div modal
            document.getElementById('modal_n_ag').innerHTML = agendamento.id_agendamento;
            document.getElementById('agendaDetalhes').innerHTML = html;
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

function formatarHorario(horario) {
    // Dividir o horário em horas e minutos
    const [horas, minutos] = horario.split(':');

    // Certificar-se de que horas e minutos têm dois dígitos
    const horasFormatadas = horas.padStart(2, '0');
    const minutosFormatados = minutos.padStart(2, '0');

    return `${horasFormatadas}:${minutosFormatados}`;
}