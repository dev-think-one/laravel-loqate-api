<?php


namespace LaravelLoqate;

use Illuminate\Support\Facades\Facade;

class Loqate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'loqate-api';
    }
}
