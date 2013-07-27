<?php

class MultipleOfIntegerInterpreter extends ChainableInterpreter
{
    private $divisor;
    private $label;

    public function __construct($divisor, $label)
    {
        $this->divisor = $divisor;
        $this->label = $label;
    }

    public function translate($number, $previousTranslation='')
    {
        $translation = $previousTranslation;
        if ($this->isAbleToTranslate($number)) {
            $translation .= $this->label;
        }

        return $this->translateUsingNextInterpreter($number, $translation);
    }

    private function isAbleToTranslate($number)
    {
        return ($number % $this->divisor === 0);
    }
}
