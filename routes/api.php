<?php

use App\Http\Controllers\ModuloController;
use App\Http\Controllers\PessoaController;
use Illuminate\Support\Facades\Route;

const DEFAULT_METHODS = [
    'index',
    'show',
    'store',
    'update',
    'destroy',
];

Route::get('/info', function () {
    phpinfo();
});

Route::post('/login', [PessoaController::class, 'login']);

Route::resource('modulo', ModuloController::class)->only(DEFAULT_METHODS);