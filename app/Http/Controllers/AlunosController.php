<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\Responsavel;

class AlunosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function listAlunosTurma($turmaId)
    {
        $alunos = Aluno::where('turma_id', $turmaId)->get();

        return response()->json($alunos, 200);
    }
    public function createAlunoWithResponsavel(Request $request)
    {
        $mAluno = new Aluno();

        $data['ok'] = false;
        $data['msg'] = "Ocorreu um erro ao tentar cadastrar o aluno";
        $aluno = $mAluno->storeAluno($request->aluno);
        if ($aluno['ok']) {
            $mResponsavel = new Responsavel();
            if (!empty($request->responsaveis)) {
                $responsaveisIds = [];
                foreach ($request->responsaveis as $key => $fields) {
                    $storeResp = $mResponsavel->storeResponsavel($fields);
                    if ($storeResp['ok']) {
                        $responsaveisIds[] = $storeResp['responsavel_id'];
                    }
                }
                $aluno['aluno']->responsaveis()->sync($responsaveisIds);
                $data['ok'] = true;
                $data['msg'] = "Aluno e Responsáveis cadastrado com sucesso.";
            }
        }
    }

    public function editAluno($id, Request $request)
    {
        $data['ok'] = false;
        $data['msg'] = "Ocorreu um erro ao tentar atualizar o aluno";
        $mAluno = new Aluno();
        $aluno = $mAluno->updateAluno($id, $request);
        if ($aluno['ok']) {
            $data['ok'] = true;
            $data['msg'] = "As informações do aluno foi foram atualizadas com sucesso.";
        }
        return response()->json($data, $data['ok'] ? 200 : 500);
    }

    public function destroyAluno($id)
    {
        $data['ok'] = false;
        $data['msg'] = "Ocorreu um erro ao tentar remover o aluno";

        if (Aluno::destroy($id)) {
            $data['ok'] = true;
            $data['msg'] =  "Aluno removido com sucesso.";
        }
        return response()->json($data,$data['ok'] ? 200 : 500);
    }
}
