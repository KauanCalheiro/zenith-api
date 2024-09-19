<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Services\ApiService;
use Exception;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public static function login(Request $request)
    {
        try {
            $data = $request->all();
    
            $id = $data['id'];
            $password = $data['password'];
    
            $user = Pessoa::find($id);
    
            if ($user) {
                if ($user->password == md5($password)) {
                    return ApiService::response($user);
                } else {
                    throw new \Exception('Senha incorreta', 401);
                }
            } else {
                throw new \Exception('Usuário não encontrado', 404);
            }
            return ApiService::response($request->all());
        } catch (Exception $e) {
            return ApiService::responseError($e);
        }
    }
}