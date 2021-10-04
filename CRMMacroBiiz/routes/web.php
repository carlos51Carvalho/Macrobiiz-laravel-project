<?php

use App\Http\Controllers\AlertasController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FaturasController;
use App\Http\Controllers\DominiosController;
use App\Http\Controllers\AlojamentosController;
use App\Http\Controllers\OrcamentosController;
use App\Http\Controllers\ContratosController;
use App\Http\Controllers\FeriasController;
use App\Http\Controllers\FaltasController;
use App\Http\Controllers\SegurosController;
use App\Http\Controllers\ColaboradoresController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\VencimentosController;

use App\Models\cliente;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'ClienteController@index');
Route::get('/i', 'ClienteController@indexI');
Route::get('novo_cliente', 'ClienteController@create');
Route::post('gravar_cliente', 'ClienteController@store');
Route::get('eliminar_cliente/{id}', 'ClienteController@destroy');
Route::get('editar_cliente/{id}', 'ClienteController@edit');
Route::post('atualizar_cliente/{id}', 'ClienteController@update');
Route::get('perfil_cliente/{id}', 'ClienteController@show');

Route::get('/teste', 'ClienteController@teste');


Route::get('index_faturas', 'FaturasController@index');
Route::get('nova_fatura', 'FaturasController@create');
Route::post('gravar_fatura', 'FaturasController@store');
Route::get('eliminar_fatura/{id}', 'FaturasController@destroy');
Route::get('editar_fatura/{id}', 'FaturasController@edit');
Route::post('atualizar_fatura/{id}', 'FaturasController@update');
Route::get('vista_fatura/{id}', 'FaturasController@show');


Route::get('index_dominios', 'DominiosController@index');
Route::get('nova_dominio', 'DominiosController@create');
Route::post('gravar_dominio', 'DominiosController@store');
Route::get('eliminar_dominio/{id}', 'DominiosController@destroy');
Route::get('editar_dominio/{id}', 'DominiosController@edit');
Route::post('atualizar_dominio/{id}', 'DominiosController@update');
Route::get('vista_dominio/{id}', 'DominiosController@show');


Route::get('index_alojamentos', 'AlojamentosController@index');
Route::get('nova_alojamento', 'AlojamentosController@create');
Route::post('gravar_alojamento', 'AlojamentosController@store');
Route::get('eliminar_alojamento/{id}', 'AlojamentosController@destroy');
Route::get('editar_alojamento/{id}', 'AlojamentosController@edit');
Route::post('atualizar_alojamento/{id}', 'AlojamentosController@update');
Route::get('vista_alojamento/{id}', 'AlojamentosController@show');


Route::get('index_outros', 'OutrosController@index');
Route::get('nova_outro', 'OutrosController@create');
Route::post('gravar_outro', 'OutrosController@store');
Route::get('eliminar_outro/{id}', 'OutrosController@destroy');
Route::get('editar_outro/{id}', 'OutrosController@edit');
Route::post('atualizar_outro/{id}', 'OutrosController@update');
Route::get('vista_outro/{id}', 'OutrosController@show');


Route::get('index_orcamentos', 'OrcamentosController@index');
Route::get('nova_orcamento', 'OrcamentosController@create');
Route::post('gravar_orcamento', 'OrcamentosController@store');
Route::get('eliminar_orcamento/{id}', 'OrcamentosController@destroy');
Route::get('editar_orcamento/{id}', 'OrcamentosController@edit');
Route::post('atualizar_orcamento/{id}', 'OrcamentosController@update');
Route::get('vista_orcamento/{id}', 'OrcamentosController@show');




//-------------------------------------------------------------


Route::get('index_colaborador', 'ColaboradoresController@index');
Route::get('novo_colaborador', 'ColaboradoresController@create');
Route::post('gravar_colaborador', 'ColaboradoresController@store');
Route::get('eliminar_colaborador/{id}', 'ColaboradoresController@destroy');
Route::get('editar_colaborador/{id}', 'ColaboradoresController@edit');
Route::post('atualizar_colaborador/{id}', 'ColaboradoresController@update');
Route::get('perfil_colaborador/{id}', 'ColaboradoresController@show');

Route::get('folha_vencimentos/{id}', 'ColaboradoresController@showVencimentos' );
Route::get('folha_despesas/{id}', 'ColaboradoresController@showDespesas' );
Route::get('marcacao_ferias/{id}', 'ColaboradoresController@showFerias' );
Route::get('marcacao_faltas/{id}', 'ColaboradoresController@showFaltas' );

Route::get('/searchcolab', 'ColaboradoresController@teste');



Route::get('index_contratos', 'ContratosController@index');
Route::get('nova_contrato', 'ContratosController@create');
Route::post('gravar_contrato', 'ContratosController@store');
Route::get('eliminar_contrato/{id}', 'ContratosController@destroy');
Route::get('editar_contrato/{id}', 'ContratosController@edit');
Route::post('atualizar_contrato/{id}', 'ContratosController@update');
Route::get('vista_contrato/{id}', 'ContratosController@show');


Route::get('index_seguros', 'SegurosController@index');
Route::get('nova_seguro', 'SegurosController@create');
Route::post('gravar_seguro', 'SegurosController@store');
Route::get('eliminar_seguro/{id}', 'SegurosController@destroy');
Route::get('editar_seguro/{id}', 'SegurosController@edit');
Route::post('atualizar_seguro/{id}', 'SegurosController@update');
Route::get('vista_seguro/{id}', 'SegurosController@show');


Route::get('index_despesas', 'DespesasController@index');
Route::get('nova_despesa', 'DespesasController@create');
Route::post('gravar_despesa', 'DespesasController@store');
Route::get('eliminar_despesa/{id}', 'DespesasController@destroy');
Route::get('editar_despesa/{id}', 'DespesasController@edit');
Route::post('atualizar_despesa/{id}', 'DespesasController@update');
Route::get('vista_despesa/{id}', 'DespesasController@show');


Route::get('index_vencimentos', 'VencimentosController@index');
Route::get('nova_vencimento', 'VencimentosController@create');
Route::post('gravar_vencimento', 'VencimentosController@store');
Route::get('eliminar_vencimento/{id}', 'VencimentosController@destroy');
Route::get('editar_vencimento/{id}', 'VencimentosController@edit');
Route::post('atualizar_vencimento/{id}', 'VencimentosController@update');
Route::get('vista_vencimento/{id}', 'VencimentosController@show');



Route::get('homepage', 'AlertasController@index');
Route::get('editar_alerta/{id}', 'AlertasController@edit');
Route::post('atualizar_alerta/{id}', 'AlertasController@update');
Route::get('eliminar_alerta/{id}', 'AlertasController@destroy');
Route::get('eliminar_alerta_aloj/{id}', 'AlertasController@destroyA');


Route::get('nova_ferias/{id}', 'FeriasController@create');
Route::post('gravar_ferias', 'FeriasController@store');
Route::get('eliminar_ferias/{id}', 'FeriasController@destroy');
Route::get('editar_ferias/{id}', 'FeriasController@edit');
Route::post('atualizar_ferias/{id}', 'FeriasController@update');


Route::get('nova_faltas/{id}', 'FaltasController@create');
Route::post('gravar_faltas', 'FaltasController@store');
Route::get('eliminar_faltas/{id}', 'FaltasController@destroy');
Route::get('editar_faltas/{id}', 'FaltasController@edit');
Route::post('atualizar_faltas/{id}', 'FaltasController@update');

//Route::resource('tasks', 'TasksController');
Route::get('admin', 'TaskController@index');
Route::get('nova_task', 'TaskController@create');
Route::post('gravar_task', 'TaskController@store');



Route::get('eliminar_task/{id}', 'TaskController@destroy');



Route::get('eliminar_categoria/{id}', 'TaskController@destroyCategoria');
Route::post('gravar_categoria', 'TaskController@storeCategoria');

//-----------------------------------------------------------------------------//


Route::get('login', 'UsuariosController@logForm');
Route::post('executar_login', 'UsuariosController@loginExec');

Route::get('inserir_usuarios', 'UsuariosController@InserirUser');

Route::get('criar_conta', 'UsuariosController@CriarConta');
Route::post('store_conta', 'UsuariosController@store');

Route::get('recuperar_conta', 'UsuariosController@RecuperarConta');
Route::post('recuperacao','UsuariosController@Recuperacao');

Route::get('logout', 'UsuariosController@logout');

Route::get('index_users', 'UsuariosController@indexUsers');
Route::get('edit_users/{id}', 'UsuariosController@editUser');
Route::post('atualizar_usuario/{id}', 'UsuariosController@updateUser');
Route::get('eliminar_usuario/{id}', 'UsuariosController@destroyUser');
Route::get('vista_usuario/{id}', 'UsuariosController@showUser');

