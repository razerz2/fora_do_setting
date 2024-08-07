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

use App\GastosPessoais;
use App\GastosProfissionais;
use App\Pagamentos;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    // Rotas autenticadas aqui
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('Users', UsersController::class);
    Route::get('/Users/inativos/', 'UsersController@indexInativos')->name('Users.inativos');
    Route::get('/Users/editPassword/{id}', 'UsersController@editPassword')->name('Users.editPassword');
    Route::post('/Users/EditarPassword/{id}', 'UsersController@updatePassword')->name('Users.changePassword');
    Route::post('/Users/ativar/', 'UsersController@ativar')->name('Users.ativar');
    Route::post('/Users/desativar/', 'UsersController@desativar')->name('Users.desativar');
    
    Route::resource('Pacientes', PacientesController::class);
    Route::post('/Pacientes/ativar/', 'PacientesController@ativar')->name('Pacientes.ativar');
    Route::post('/Pacientes/desativar/', 'PacientesController@desativar')->name('Pacientes.desativar');
    Route::get('/Pacientes/disable/{id}', 'PacientesController@desativarView')->name('Pacientes.desativarView');
    
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
    // Adcionar mais rotas aqui, no decorrer do projeto...
});