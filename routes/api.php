<?php

use App\Http\Controllers\PessoaController;
use App\Models\Pessoa;
use Illuminate\Support\Facades\Route;

Route::get('/info', function () {
    phpinfo();
});

Route::post('/login', [PessoaController::class, 'login']);