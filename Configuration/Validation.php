<?php

class Validation
{

    static function validerChamp(string $champ) : bool {
        if (!isset($champ) || empty($champ))
        {
            return false;
        }
        return true;
    }

    static function nettoyerChamp(string $champ) : string {
        $champ=filter_var($champ,FILTER_SANITIZE_STRING);
        return $champ;
    }

    static function nettoyerInt(int $nb) : int {
        $nb = filter_var($nb, FILTER_SANITIZE_NUMBER_INT);
        return $nb;
    }

    static function hachagePass(string $pass) : string {
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        return $pass;
    }
}