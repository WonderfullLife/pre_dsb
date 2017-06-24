<?php
/**
 * Created by PhpStorm.
 * User: Plue
 * Date: 03/04/2017
 * Time: 09.18
 */

namespace App\Http\Helper;


class format
{
    public function bersih($string)
    {
        return strtolower(preg_replace("/(\W)+/", '', strtolower($string)));
    }

    public function bersihSelainSpasi($string)
    {
        return strtolower(str_replace('  ', ' ', preg_replace("/[^ \w]+/", "", $string)));
    }

}