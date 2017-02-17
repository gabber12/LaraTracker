<?php

namespace Laratracker\Links\Facades;

use Laratracker\Links\Builder;
use Illuminate\Support\Facades\Facade;

class Links extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Builder::class;
    }
}
