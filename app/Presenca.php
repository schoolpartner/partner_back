<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Professor;
class Presenca extends Model
{
    protected $table = "presencas";
    protected $fillable = ['turma_id', 'aluno_id', 'professor_id', 'presente','sms_enviado'];
    public $timestamps = true;

    public function storePresanca($field)
    {
        $res['ok'] = false;
        foreach ($field as $key => $value) {
            $this[$key] = $value;
        }
        $professor = Professor::where('user_id',Auth::user()->id)->first();
        $this['professor_id'] = $professor->id;
        $this['materia_id'] = $professor->materia_id;
        if ($this->save()) {
            $res['ok'] = true; 
        }
        return $res;
    }
}
