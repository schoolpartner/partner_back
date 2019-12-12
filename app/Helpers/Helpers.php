<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class Helpers
{
    public static function generateCodes($qtyCaraceters = 6)
    {

        //Letras maiúsculas embaralhadas
        $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
     
        //Números aleatórios
        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;
     

     
        //Junta tudo
        $characters = $capitalLetters.$numbers;
     
        //Embaralha e pega apenas a quantidade de caracteres informada no parâmetro
        $code = substr(str_shuffle($characters), 0, $qtyCaraceters);
     
        //Retorna a senha
        return $code;
    }
}
