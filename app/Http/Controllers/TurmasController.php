<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Turma;

class TurmasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function listTurmas()
    {
        $turmas = Turma::all();

        return response()->json($turmas, 200);
    }
    public function createTurma(Request $request)
    {
        $data['ok'] = false;
        $data['msg'] = "Ocorreu um erro ao tentar cadastrar a turma, por favor tente mais tarde.";
        $mTurma = new Turma();
        $turma = $mTurma->storeTurma($request->all());
        if ($turma['ok']) {
            $data['ok'] = true;
            $data['msg'] = "Turma Cadastrada com sucesso";
        }
        return response()->json($data, $data['ok'] ? 200 : 500);
    }
    public function editTurma($id, Request $request)
    {
        $data['ok'] = false;
        $data['msg'] = "Ocorreu um erro ao tentar atualizar a turma, por favor tente mais tarde.";
        $mTurma = new Turma();
        $turma = $mTurma->updateTurma($id, $request->all());

        if ($turma['ok']) {
            $data['ok'] = true;
            $data['msg'] = "Turma Atualizada com sucesso";
        }
        return response()->json($data, $data['ok'] ? 200 : 500);
    }
    public function destroyTurma($id)
    {
        $data['ok'] = false;
        $data['msg'] = "Ocorreu um erro ao tentar remover a turma, por favor tente mais tarde.";
        if (Turma::destroy($id)) {
            $data['ok'] = true;
            $data['msg'] = "Turma removida com sucesso.";
        }
        return response()->json($data, $data['ok'] ? 200 : 500);
    }
}
