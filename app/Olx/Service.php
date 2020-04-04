<?php

namespace App\Olx;

abstract class Service
{
    public function __construct()
    {
        ini_set('mbstring.func_overload', 0);
    }
}