<?php

namespace Meditate\IdentityCard\Contracts;

interface IdentityCard
{
    /**
     * Validate ID number.
     *
     * @param  string  $id_number
     * @return boolean
     */
    public function check(string $id_number = '');

    /**
     * Make a fake ID number.
     *
     * @param  string|null  $location
     * @param  integer|null  $gender
     * @return string
     */
    public function make($location = null, $gender = null);
}
