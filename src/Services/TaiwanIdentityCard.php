<?php

namespace Meditate\IdentityCard\Services;

use Meditate\IdentityCard\Contracts\IdentityCard;

class TaiwanIdentityCard implements IdentityCard
{
    /**
     * The number which the first letter represents.
     *
     * @var array
     */
    protected $locations = [
        'A' =>  1, 'B' => 10, 'C' => 19, 'D' => 28, 'E' => 37, 'F' => 46, 'G' => 55,
        'H' => 64, 'I' => 39, 'J' => 73, 'K' => 82, 'L' =>  2, 'M' => 11, 'N' => 20,
        'O' => 48, 'P' => 29, 'Q' => 38, 'R' => 47, 'S' => 56, 'T' => 65, 'U' => 74,
        'V' => 83, 'W' => 21, 'X' =>  3, 'Y' => 12, 'Z' => 30
    ];

    /**
     * The weights which the every numbers represents.
     *
     * @var array
     */
    protected $weights = [8, 7, 6, 5, 4, 3, 2, 1, 1];

    /**
     * Validate ID number.
     *
     * @param  string  $id_number
     * @return boolean
     */
    public function check(string $id_number = '')
    {
        if (!$this->checkIdNumberFormat($id_number)) {
            return false;
        }

        $id_number_chars = str_split($id_number);

        if (!in_array($id_number_chars[1], [1, 2])) {
            return false;
        }

        $count = $this->locations[$id_number_chars[0]];
        foreach ($this->weights as $i => $weight) {
            $count += $id_number_chars[$i + 1] * $weight;
        }

        return ($count % 10 === 0) ? true : false;
    }

    /**
     * Make a fake ID number.
     *
     * @param  string|null  $location
     * @param  integer|null  $gender
     * @return string
     */
    public function make($location = null, $gender = null)
    {
        if (is_null($location)) {
            $location = array_rand($this->locations);
        } elseif (!(is_string($location) && array_key_exists($location, $this->locations))) {
            throw new \Exception("Argument 1 must be of the char 'A' to 'Z'", 1);
        }

        if (is_null($gender)) {
            $gender = random_int(1, 2);
        } elseif (!(is_int($gender) && in_array($gender, [1, 2]))) {
            throw new \Exception("Argument 2 must be of the integer 1 or 2", 1);
        }

        $fake_id_number = $location . $gender . random_int(1000000, 9999999);

        $id_number_chars = str_split($fake_id_number);

        $count = $this->locations[$id_number_chars[0]];
        foreach ($this->weights as $i => $weight) {
            if ($i == 8) break;
            $count += $id_number_chars[$i + 1] * $weight;
        }

        $fake_id_number .= ($count % 10 == 0) ? 0 : (10 - ($count % 10));

        return $fake_id_number;
    }

    /**
     * Check ID number format.
     *
     * @param  string  $id_number
     * @return boolean
     */
    private function checkIdNumberFormat($id_number)
    {
        return (preg_match('/(^[A-Z][0-9]{9})/u', $id_number) === 1) ? true : false;
    }
}
