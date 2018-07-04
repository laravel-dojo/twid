<?php

namespace Meditate\IdentityCard;

use IdentityCard\Services\TaiwanIdentityCard;

class IdentityCardValidator
{
    public function twIdCheck($attribute, $value)
    {
        $id_card_tw = new TaiwanIdentityCard;

        return $id_card_tw->check($value ?? '');
    }
}
