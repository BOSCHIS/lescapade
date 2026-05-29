<?php

namespace App\Utils;

class Tools
{
    public static function sanitize(string $str): string
    {
        $str = trim($str);
        $str = strip_tags($str);
        $str = htmlspecialchars($str, ENT_NOQUOTES);
        return $str;
    }
}
