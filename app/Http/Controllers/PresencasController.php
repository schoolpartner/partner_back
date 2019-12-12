<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Presenca;

class PresencasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function storePresencas(Request $request)
    {
        $data['ok'] = false;
        $data['msg'] = "Ocorreu um erro ao tentar registrar as presenças.";
        if (!empty($request->presencas)) {
            $mPresenca = new Presenca();
            $data['qtdFalhasSms'] = 0;
            $data['qtdFalhasSave'] = 0;
            foreach ($request->presencas as $key => $value) {
                $presenca = $mPresenca->storePresanca($value);
                if (!$presenca['ok']) {
                    $data['qtdFalhasSave'] = $data['qtdFalhasSave'] + 1;
                }
            }

            if ($data['qtdFalhasSave'] === 0) {
                $data['ok'] = true;
                $data['msg'] = "Todos as presenças foram registradas.";
            }
        }
        return response()->json($data,$data['ok'] ? 200 : 500);
    }
}
