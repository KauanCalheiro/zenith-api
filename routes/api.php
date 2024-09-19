<?php

use App\Http\Controllers\PessoaController;
use App\Models\Pessoa;
use Illuminate\Support\Facades\Route;

Route::get('/katatau', function () {
    return response()->json(['message' => 'Katatau was here!']);
});

Route::post('/login', [PessoaController::class, 'login']);