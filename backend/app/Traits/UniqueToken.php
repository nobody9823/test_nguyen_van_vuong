<?php

namespace App\Traits;

trait UniqueToken
{
    public static function getToken()
    {
        return uniqid(random_int(0, 99999999) . '-');
    }
}
