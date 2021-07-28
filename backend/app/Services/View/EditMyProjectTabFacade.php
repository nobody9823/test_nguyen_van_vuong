<?php

namespace App\Services\View;

use Illuminate\Support\Facades\Facade;

class EditMyProjectTabFacade extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'EditMyProjectTab';
    }
}