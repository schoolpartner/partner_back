<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponsaveisAluno extends Model
{
   protected $table = "responsaveis_alunos";
   protected $fillable = ['aluno_id','responsavel_id'];
}
