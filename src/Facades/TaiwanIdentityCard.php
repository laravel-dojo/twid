<?php

namespace Meditate\IdentityCard\Facades;

use Meditate\IdentityCard\TaiwanIdentityCard as TaiwanIdentityCardService;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Meditate\IdentityCard\TaiwanIdentityCard
 */
class TaiwanIdentityCard extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return TaiwanIdentityCardService::class;
    }
}
