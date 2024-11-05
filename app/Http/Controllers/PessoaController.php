<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Services\ApiService;
use Exception;
use Illuminate\Http\Request;

class PessoaController extends Controller {
    public static function login(Request $request){
        try {
            $id       = $request->id;
            $password = $request->password;

            $user = Pessoa::find($id);

            if ($user) {
                if ($user->password == md5($password)) {
                    return ApiService::response($user);
                } else {
                    throw new Exception('Senha incorreta', 401);
                }
            } else {
                throw new Exception('Usuário não encontrado', 404);
            }
        } catch (Exception $e) {
            return ApiService::responseError($e);
        }
    }

    public static function logout(Request $request){
        $user = Pessoa::find($request->id);

        return $user
        ? ApiService::response($user)
        : ApiService::responseError(
            new Exception(
                'Usuário não encontrado',
                404
            )
        );
    }
}