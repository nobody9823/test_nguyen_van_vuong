<?php

namespace App\Services\View;

use Illuminate\Support\Facades\Facade;

class ProgressBarStateFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ProgressBarState';
    }
}
