<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Session;

class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function sis_permissao($param = 0)
    {
        $acessos =  Session::get('ACESSO_PERMISSAO');
        return (in_array(1, $acessos) || in_array($param, $acessos));
    }
}