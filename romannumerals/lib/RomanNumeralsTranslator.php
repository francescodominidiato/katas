<?php

class RomanNumeralsTranslator
{
    public function fromArabic($number)
    {
        if ($number > 3) {
            return str_repeat('I', (5 - $number)) . 'V';
        }
        return str_repeat('I', $number);
    }
}
