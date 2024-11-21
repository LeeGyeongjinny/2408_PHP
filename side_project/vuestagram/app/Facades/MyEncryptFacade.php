<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MyEncryptFacade extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'MyEncrypt';
    } // 이거 이름 고정
}