<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsavel extends Model
{
    protected $table = "responsaveis";
    protected $fillable = [
        'name',
        'data_nascimento',
        'tipo',
        'email_1',
        'email_2',
        'telefone_1',
        'telefone_2'
    ];
    public $timestamps = true;

    public function storeResponsavel($field)
    {
        $res['ok'] = false;
        foreach ($field as $key => $value) {
            $this[$key] = $value;
        }
        if ($this->save()) {
            $res['ok'] = true;
            $res['responsavel_id'] = $this->id;
        }

        return $res;
    }
}
