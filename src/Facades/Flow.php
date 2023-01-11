<?php

namespace HaneulChile\Flow\Facades;

use Illuminate\Support\Facades\Facade;

class Flow extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'flow';
    }
}
