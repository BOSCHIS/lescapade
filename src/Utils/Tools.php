<?php

namespace App\Utils;

class Tools
{
    /**
     * Méthode pour sanitize les chaines de caractères
     * @param string $str Chaine à nettoyer
     * @return string chaine nettoyé
     */
    public static function sanitize(string $str): string
    {
        $str = trim($str);
        $str = strip_tags($str);
        $str = htmlspecialchars($str, ENT_NOQUOTES);
        return $str;
    }
}
