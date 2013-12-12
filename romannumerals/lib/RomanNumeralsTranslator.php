<?php

class RomanNumeralsTranslator
{
    public function fromArabic($number)
    {
        if ($number == 1) {
            return 'I';
        }
        if ($number == 2) {
            return 'II';
        }

    }
}
