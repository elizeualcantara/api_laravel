<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// LISTAR
Route::get('enderecos', "EnderecoController@index");

// CONSULTAR
Route::get('enderecos/{endereco}', "EnderecoController@show");

// INCLUIR
Route::post('enderecos', "EnderecoController@store");

// EDITAR
Route::put('enderecos/{endereco}', "EnderecoController@update");

// EXCLUIR
Route::delete('enderecos/{endereco}', "EnderecoController@remove");

// CONSULTAR CEP (BASE LOCAL E CONTINGENCIA BASE EXTERNA)
Route::get('enderecos/cep/{endereco}', "EnderecoController@showcep");

// CONSULTAR LOGRADOURO (FUZZY SEARCH)
Route::get('enderecos/logradouro/{endereco}', "EnderecoController@showfuzzylogradouro");
