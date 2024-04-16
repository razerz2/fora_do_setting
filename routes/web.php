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

    // Adcionar mais rotas aqui, no decorrer do projeto...
});