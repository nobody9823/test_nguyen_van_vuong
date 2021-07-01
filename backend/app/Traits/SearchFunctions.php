<?php

namespace App\Traits;

use Request;

trait SearchFunctions
{
    public function getSearchWordInArray()
    {
        if (Request::query('word')) {
            $words = str_replace("　", " ", Request::query('word'));
            return explode(" ", $words);
        }
    }
}
