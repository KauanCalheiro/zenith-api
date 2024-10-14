<?php

use App\Http\Controllers\ModuloController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\TreinoController;
use Illuminate\Support\Facades\Route;

const DEFAULT_METHODS = [
    'index',
    'show',
    'store',
    'update',
    'destroy',
];

Route::get('/', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::post('/login' , [PessoaController::class, 'login' ]);
Route::post('/logout', [PessoaController::class, 'logout']);

Route::resource('modulo', ModuloController::class)->only(DEFAULT_METHODS);
Route::resource('treino', TreinoController::class)->only(DEFAULT_METHODS);

Route::get('/usuario/{ref_pessoa}/treino', [TreinoController::class, 'getTreinoByPessoa']);