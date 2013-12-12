<?php

class RomanNumeralsTranslator
{
    public function fromArabic($number)
    {
        return str_repeat('I', $number);
    }
}
