<?php

namespace Rakit\Validation\Rules;

use Rakit\Validation\Rule;

class PartitaIVA extends Rule
{

    /** @var string */
    protected $message = "The :attribute has not a valid format";

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
        if (strlen($value) != 11 || preg_match("/^[0-9]+\$/D", $value) != 1) {
            return false;
        }
        $s = 0;
        for ($i = 0; $i <= 9; $i += 2) {
            $s += ord($value[$i]) - ord('0');
        }
        for ($i = 1; $i <= 9; $i += 2) {
            $c = 2 * (ord($value[$i]) - ord('0'));
            if ($c > 9) $c = $c - 9;
            $s += $c;
        }
        $control = (10 - $s % 10) % 10;
        if ($control != (ord($value[10]) - ord('0'))) {
            return false;
        }
        return true;
    }
}
