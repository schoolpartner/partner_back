<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $table = "professores";
    protected $fillable = ['user_id','turma_id','materia_id'];
    public $timestamps = true;

    public function storeProfessor($field)
    {
        $res['ok'] = false;
        foreach ($field as $key => $value) {
            $this[$key] = $value;
        }
      if ($this->save()) {
          $res['ok'] = true;
      }
      return $res;
    }

}
