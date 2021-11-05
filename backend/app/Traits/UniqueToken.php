<?php

namespace App\Traits;

trait UniqueToken {

    public static function getToken()
    {
        return uniqid('', true);
    }
}