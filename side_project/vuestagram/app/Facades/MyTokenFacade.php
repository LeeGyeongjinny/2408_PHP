<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MyTokenFacade extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'MyToken';
    } // 이거 이름 고정
}