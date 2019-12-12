<?php

//Converte datas
function converterData($valor, $formato)
{
    return date($formato, strtotime($valor));
}

//Limita quantidade maxima de caractéres que ser exibidos
function limitString($texto, $max)
{
    return substr_replace($texto, (strlen($texto) > $max ? '...' : ''), $max);
}

