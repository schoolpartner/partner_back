<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;

class Aluno extends Model
{
    protected $table = "alunos";
    protected $fillable = [
        'name',
        'data_nascimento',
        'codigo',
        'turma_id',
    ];
    public $timestamps = true;
    public function storeAluno($field)
    {
        $resp['ok'] = false;
        foreach ($field as $key => $value) {
            $this[$key] = $value;
        }
        $this->codigo = Helpers::generateCodes();
        if ($this->save()) {
            $res['ok'] = true;
            $res['aluno'] = $this;
        }
        return $res;
    }
    public function updateAluno($id, $field)
    {
        $res['ok'] = false;
        $aluno = $this->find($id);
        foreach ($field as $key => $value) {
            $aluno[$key] = $value;
        }
        if ($aluno->save()) {
            $res['ok'] = true;
        }
        return $res;
    }
    public function responsaveis()
    {
        return $this->belongsToMany(ResponsaveisAluno::class, 'responsaveis_alunos', 'aluno_id', 'responsavel_id');
    }
}
