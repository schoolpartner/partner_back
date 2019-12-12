<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;

class ProfessoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function tornarProfessor(Request $request)
    {
        $mProfessor = new Professor();
        $data['ok'] = false;
        $data['msg'] = "Não foi possivel tornar o usuário professor, por favor tente mais tarde.";
        if ($mProfessor->storeProfessor($request->all())) {
            $data['ok'] = true;
            $data['msg'] = "Usuário Agora é um professor";
        }

        return response()->json($data, $data['ok'] ? 200 : 500);
    }
}
