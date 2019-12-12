<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helpers;

class Turma extends Model
{
    protected $table = "turmas";
    protected $fillable = ['codigo', 'sala', 'turno'];
    public $timestamps = true;

    public function storeTurma($field)
    {
        $res['ok'] = false;
        $this->codigo = Helpers::generateCodes();
        foreach ($field as $key => $value) {
            $this[$key] = $value;
        }
        $this->codigo = Helpers::generateCodes();
        if ($this->save()) {
            $res['ok'] = true;
        }
        return $res;
    }
    public function updateTurma($id,$field)
    {
        $res['ok'] = false;
        $turma = $this->find($id);
        foreach ($field as $key => $value) {
            $turma[$key] = $value;
        }
        if ($turma->save()) {
            $res['ok'] = true;
        }
        return $res;
    }
}
