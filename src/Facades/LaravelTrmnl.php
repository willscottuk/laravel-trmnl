<?php

namespace Bnussbau\LaravelTrmnl\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bnussbau\LaravelTrmnl\LaravelTrmnl
 */
class LaravelTrmnl extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Bnussbau\LaravelTrmnl\LaravelTrmnl::class;
    }
}
