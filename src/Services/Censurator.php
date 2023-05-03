<?php

namespace App\Services;

class Censurator
{
    public function purify($phrase) {
        $gros_mots = ["chiennasse", "putain"];
        $phrase_purifiee = str_ireplace($gros_mots, '***', $phrase);
        return $phrase_purifiee;
    }
}