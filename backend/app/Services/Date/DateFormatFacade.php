<?php
namespace App\Services\Date;

use Illuminate\Support\Facades\Facade;

class DateFormatFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'DateFormat';
    }
}