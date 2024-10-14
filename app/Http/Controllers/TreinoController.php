<?php

namespace App\Http\Controllers;

use App\Models\Treino;
use App\Models\TreinoPessoa;
use App\Services\ApiService;
use Exception;
use Illuminate\Http\Request;

class TreinoController extends Controller
{
    public static function getTreinoByPessoa(Request $request)
    {
        try {
            $treinoPessoa = TreinoPessoa::where('ref_pessoa', $request->ref_pessoa)->firstOrFail();

            $treino = $treinoPessoa->treino->load('exercicios_treino');

            $treinoArray = $treino->toArray();
            $treinoArray['exercicios_treino'] = $treino->exercicios_treino->groupBy('grupo')->toArray();

            return ApiService::response($treinoArray);
        }
        catch (Exception $e)  {
            return ApiService::responseError($e);
        }
    }
}
 