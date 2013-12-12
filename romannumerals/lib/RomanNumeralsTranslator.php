<?php

class RomanNumeralsTranslator
{
    public function fromArabic($number)
    {
        if ($number > 3) {
            return 'IV';
        }
        return str_repeat('I', $number);
    }
}
