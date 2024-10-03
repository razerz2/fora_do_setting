<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
Route::get('/Perfil/ResetAdmin', 'PerfilController@ResetAdmin')->name('Perfil.resetAdmin');

Route::middleware('auth')->group(function () {
    // Rotas autenticadas aqui
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/home', 'HomeController@indexMonthSelect')->name('homeMonth');
    
    Route::resource('Users', UsersController::class);
    Route::get('/Users/inativos/', 'UsersController@indexInativos')->name('Users.inativos');
    Route::get('/Users/editPassword/{id}', 'UsersController@editPassword')->name('Users.editPassword');
    Route::post('/Users/EditarPassword/{id}', 'UsersController@updatePassword')->name('Users.changePassword');
    Route::post('/Users/ativar/', 'UsersController@ativar')->name('Users.ativar');
    Route::post('/Users/desativar/', 'UsersController@desativar')->name('Users.desativar');
    Route::get('/Perfil/Visualizar/', 'PerfilController@Perfil')->name('Perfil.visualizar');
    Route::get('/Perfil/AlterarSenha/', 'PerfilController@AlterarSenha')->name('Perfil.alterarSenha');
    Route::post('/Perfil/EditPassword/{id}', 'PerfilController@EditPassword')->name('Perfil.editPassword');
    
    Route::resource('Pacientes', PacientesController::class);
    Route::get('/Pacientes/inativos/list', 'PacientesController@indexInativos')->name('Pacientes.inativos');
    Route::post('/Pacientes/ativar/', 'PacientesController@ativar')->name('Pacientes.ativar');
    Route::post('/Pacientes/desativar/', 'PacientesController@desativar')->name('Pacientes.desativar');
     
    Route::resource('PacientesEndereco', PacientesEnderecoController::class);
    Route::get('PacientesEndereco/create/{id}', 'PacientesEnderecoController@create')->name('PacientesEndereco.create');
    Route::get('getPaises', 'PacientesEnderecoController@getPaises')->name('PacientesEndereco.getPaises');
    Route::get('getEstados/{pais_id}', 'PacientesEnderecoController@getEstados')->name('PacientesEndereco.getEstados');
    Route::get('getCidades/{estado_id}', 'PacientesEnderecoController@getCidades')->name('PacientesEndereco.getCidades');
    Route::get('/PacientesEndereco/verifica_endereco/{id}', 'PacientesEnderecoController@verificaEnderecoPaciente')->name('Pacientes.verificaEnderecoPaciente');
  
    Route::resource('Agendamento', AgendamentoController::class)->except('agenda');
    Route::get('/Agendamentos/Calendario', 'AgendamentoController@agenda')->name('Agendamento.agenda');
    Route::post('/Agendamentos/Calendario', 'AgendamentoController@agendaPorDia')->name('Agendamento.agendaPorDia');
    Route::post('/Agendamentos/Excluir/', 'AgendamentoController@agendamentoExcluir')->name('Agendamento.excluir');
    Route::post('/Agendamentos/Marcar/', 'AgendamentoController@agendamentoRedirecionador')->name('Agendamento.redirecionador');
    Route::post('/Agendamentos/Desmarcar/', 'AgendamentoController@agendamentoDesmarcar')->name('Agendamento.desmarcar');
    Route::post('/Agendamentos/Reagendar/', 'AgendamentoController@reagendar')->name('Agendamento.reagendar');
    Route::post('/Agendamentos/StorePaciente/', 'AgendamentoController@storeAgendamentoPaciente')->name('Agendamento.storePaciente');
    Route::post('/Agendamentos/StoreReservado/', 'AgendamentoController@storeAgendamentoReservado')->name('Agendamento.storeReservado');
    Route::post('/Agendamentos/StoreReagendarPaciente/', 'AgendamentoController@storeReagendarPaciente')->name('Agendamento.storeReagendarPaciente');
    Route::post('/Agendamentos/StoreReagendarReserva/', 'AgendamentoController@storeReagendarReserva')->name('Agendamento.storeReagendarReserva');
    Route::get('getAgendamento/{id}', 'AgendamentoController@getAgendamento')->name('Agendamentos.getAgendamento');

    Route::resource('ValidacaoAgendamento', ValidacaoAgendamentoController::class);
    Route::post('/ValidacaoAgendamento/Validar/', 'ValidacaoAgendamentoController@validar')->name('ValidacaoAgendamento.validar');
    Route::post('/ValidacaoAgendamento/ValidarSelecionados/', 'ValidacaoAgendamentoController@validarSelecionados')->name('ValidacaoAgendamento.validarSelecionados');
    Route::post('/ValidacaoAgendamento/Invalidar/', 'ValidacaoAgendamentoController@invalidar')->name('ValidacaoAgendamento.invalidar');
    
    Route::resource('SessaoPaciente', SessaoPacienteController::class);
    Route::post('/SessaoPaciente/Excluir/', 'SessaoPacienteController@Excluir')->name('SessaoPaciente.excluir');
    Route::resource('Sessao', SessaoController::class);
    Route::post('/Sessao/Excluir/', 'SessaoController@Excluir')->name('Sessao.excluir');
    Route::resource('SessaoCancelada', SessaoCanceladaController::class);

    // Rotas de pagamentos
    Route::resource('Pagamentos', PagamentosController::class);
    Route::post('/Pagamentos/Registrar_Pagamento/', 'PagamentosController@register')->name('Pagamentos.registrar');
    Route::post('/Pagamentos/Excluir/', 'PagamentosController@Excluir')->name('Pagamentos.excluir');
    Route::resource('Recibos', RecibosController::class);
    // Rotas de Gastos Profissionais
    Route::resource('GastosProfissionais', GastosProfissionaisController::class);
    Route::post('/GastosProfissionais/Excluir/', 'GastosProfissionaisController@Excluir')->name('GastosProfissionais.excluir');
    // Rotas de Gastos Pessoais 
    Route::resource('GastosPessoais', GastosPessoaisController::class);
    Route::post('/GastosPessoais/Excluir/', 'GastosPessoaisController@Excluir')->name('GastosPessoais.excluir');

    //Rota de Relatórios de Pacientes
    Route::get('Relatorios/Pacientes/', 'RelatoriosController@indexRPacientes')->name('Relatorios.Pacientes');
    Route::get('Relatorios/Pacientes/Ativos', 'RelatoriosController@PacientesAtivos')->name('Relatorios.PacientesAtivos');
    Route::get('Relatorios/Pacientes/Inativos', 'RelatoriosController@PacientesInativos')->name('Relatorios.PacientesInativos');
    Route::get('Relatorios/Pacientes/Adolescentes', 'RelatoriosController@PacientesAdolescentes')->name('Relatorios.PacientesAdolescentes');
    Route::get('Relatorios/Pacientes/Adultos', 'RelatoriosController@PacientesAdultos')->name('Relatorios.PacientesAdultos');
    Route::post('Relatorios/Pacientes/Genero', 'RelatoriosController@PacientesGenero')->name('Relatorios.PacientesPorGenero');

     //Rota de Relatórios de Pacientes
     Route::get('Relatorios/Agendamentos/', 'RelatoriosController@indexRAgendamentos')->name('Relatorios.Agendamentos');
     Route::get('Relatorios/Agendamentos/Online', 'RelatoriosController@AtendimentosOnline')->name('Relatorios.AgendamentosOnline');
     Route::get('Relatorios/Agendamentos/Presenciais', 'RelatoriosController@AtendimentosPresenciais')->name('Relatorios.AgendamentosPresenciais');
     Route::post('Relatorios/Agendamentos/Paciente', 'RelatoriosController@AtendimentosPorPaciente')->name('Relatorios.AgendamentosPorPaciente');
     Route::get('Relatorios/Agendamentos/Reservados', 'RelatoriosController@HorariosReservados')->name('Relatorios.AgendamentosReservados');
     Route::get('Relatorios/Agendamentos/Livres', 'RelatoriosController@HorariosReservados')->name('Relatorios.AgendamentosLivres');

     //Rota de Relatórios de Pagamentos
     Route::get('Relatorios/Pagamentos/', 'RelatoriosController@indexRPagamentos')->name('Relatorios.Pagamentos');
     Route::post('Relatorios/Pagamentos/Paciente/', 'RelatoriosController@PagamentosPorPaciente')->name('Relatorios.PagamentosPorPaciente');
     Route::post('Relatorios/Pagamentos/Periodo/', 'RelatoriosController@PagamentosPorPeriodo')->name('Relatorios.PagamentosPorPeriodo');
     Route::get('Relatorios/Pagamentos/Sessao/Valores_Paciente/', 'RelatoriosController@PacientesRecibo')->name('Relatorios.PacientesRecibo');
     Route::get('Relatorios/Pagamentos/Sessao/Pacientes_Inadimplentes/', 'RelatoriosController@PacientesInadimplentes')->name('Relatorios.PacientesInadimplentes');
     //Rota de Relatórios de Sessões
     
     //Rota de Relatórios de Gastos Pessoais
     Route::get('Relatorios/GastosPessoais/', 'RelatoriosController@IndexGastosPessoais')->name('Relatorios.GastosPessoais');
     Route::get('Relatorios/GastosPessoais/Mes/', 'RelatoriosController@GastosPessoais')->name('Relatorios.GastosPessoaisMes');
     Route::post('Relatorios/GastosPessoais/Periodo/', 'RelatoriosController@GastosPessoaisPeriodo')->name('Relatorios.GastosPessoaisPeriodo');

     //Rota de Relatórios de Gastos Profissionais
     Route::get('Relatorios/GastosProfissionais/', 'RelatoriosController@IndexGastosProfissionais')->name('Relatorios.GastosProfissionais');
     Route::get('Relatorios/GastosProfissionais/Mes/', 'RelatoriosController@GastosProfissionais')->name('Relatorios.GastosProfissionaisMes');
     Route::post('Relatorios/GastosProfissionais/Periodo/', 'RelatoriosController@GastosProfissionaisPeriodo')->name('Relatorios.GastosProfissionaisPeriodo');

     //Rota de Logs
     Route::get('Logs/', 'LogsController@index')->name('Logs.index');
     Route::get('Logs/Show/{id}', 'LogsController@show')->name('Logs.show');

      //Rota de Notificações
      Route::get('Notificacao/', 'NotificacaoController@index')->name('Notificacao.index');
      Route::get('Notificacao/Show/{id}', 'NotificacaoController@show')->name('Notificacao.show');

      //Rota de Configurações
      Route::get('Configuracoes/', 'SettingController@index')->name('Configuracoes.index');
      Route::get('Configuracoes/Edit/', 'SettingController@indexConfig')->name('Configuracoes.indexConfig');
      Route::post('Configuracoes/Update/', 'SettingController@update')->name('Configuracoes.update');

      //Rota de Configurações - Período Agendamento
      Route::get('Configuracoes/Periodo/', 'AgendamentoPeriodoController@index')->name('Periodo.index');
      Route::get('Configuracoes/Periodo/{id}/edit', 'AgendamentoPeriodoController@edit')->name('Periodo.edit');
      Route::post('Configuracoes/Periodo/{id}/update/', 'AgendamentoPeriodoController@update')->name('Periodo.update');

      //Rota de Configurações - Motivo de Inativação
      Route::get('Configuracoes/MotivoInativacao/', 'MotivoInativacaoController@index')->name('MotivoInativacao.index');
      Route::post('Configuracoes/MotivoInativacao/Store/', 'MotivoInativacaoController@store')->name('MotivoInativacao.store');
      Route::post('Configuracoes/MotivoInativacao/Update/', 'MotivoInativacaoController@update')->name('MotivoInativacao.update');
      Route::post('Configuracoes/MotivoInativacao/Destroy/', 'MotivoInativacaoController@destroy')->name('MotivoInativacao.destroy');

      //Rota de Configurações - Motivo para Validações
      Route::get('Configuracoes/MotivoValidacoes/', 'MotivoValidacoesController@index')->name('MotivoValidacoes.index');
      Route::post('Configuracoes/MotivoValidacoes/Store/', 'MotivoValidacoesController@store')->name('MotivoValidacoes.store');
      Route::post('Configuracoes/MotivoValidacoes/Update/', 'MotivoValidacoesController@update')->name('MotivoValidacoes.update');
      Route::post('Configuracoes/MotivoValidacoes/Destroy/', 'MotivoValidacoesController@destroy')->name('MotivoValidacoes.destroy');

      //Rota de Configurações - Gênero dos Pacientes
      Route::get('Configuracoes/PacienteGenero/', 'PacienteGeneroController@index')->name('PacienteGenero.index');
      Route::post('Configuracoes/PacienteGenero/Store/', 'PacienteGeneroController@store')->name('PacienteGenero.store');
      Route::post('Configuracoes/PacienteGenero/Update/', 'PacienteGeneroController@update')->name('PacienteGenero.update');
      Route::post('Configuracoes/PacienteGenero/Destroy/', 'PacienteGeneroController@destroy')->name('PacienteGenero.destroy');

      //Rota de Configurações - Locais
      Route::get('Configuracoes/Locais/', 'LocaisController@index')->name('Locais.index');
      //Paises
      Route::get('Configuracoes/Locais/Paises/', 'LocaisController@indexPaises')->name('LocaisPaises.index');
      Route::post('Configuracoes/Locais/Paises/Store/', 'LocaisController@storePaises')->name('LocaisPaises.store');
      Route::post('Configuracoes/Locais/Paises/Update/', 'LocaisController@updatePaises')->name('LocaisPaises.update');
      Route::post('Configuracoes/Locais/Paises/Destroy/', 'LocaisController@destroyPaises')->name('LocaisPaises.destroy');
      //Estados
      Route::get('Configuracoes/Locais/Estados/', 'LocaisController@indexEstados')->name('LocaisEstados.index');
      Route::post('Configuracoes/Locais/Estados/Store/', 'LocaisController@storeEstados')->name('LocaisEstados.store');
      Route::post('Configuracoes/Locais/Estados/Update/', 'LocaisController@updateEstados')->name('LocaisEstados.update');
      Route::post('Configuracoes/Locais/Estados/Destroy/', 'LocaisController@destroyEstados')->name('LocaisEstados.destroy');
      //Cidades
      Route::get('Configuracoes/Locais/Cidades/', 'LocaisController@indexCidades')->name('LocaisCidades.index');
      Route::post('Configuracoes/Locais/Cidades/Store/', 'LocaisController@storeCidades')->name('LocaisCidades.store');
      Route::post('Configuracoes/Locais/Cidades/Update/', 'LocaisController@updateCidades')->name('LocaisCidades.update');
      Route::post('Configuracoes/Locais/Cidades/Destroy/', 'LocaisController@destroyCidades')->name('LocaisCidades.destroy');

    // Adcionar mais rotas aqui, no decorrer do projeto...
});