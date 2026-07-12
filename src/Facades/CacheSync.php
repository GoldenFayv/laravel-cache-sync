<?php

namespace Goldenfavour\CacheSync\Facades;

use Illuminate\Support\Facades\Facade;

class CacheSync extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Goldenfavour\CacheSync\CacheSync::class;
    }
}
