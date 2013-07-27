<?php

class FortytwoInterpreter extends ChainableInterpreter
{
    public function translate($number, $previousTranslation='')
    {
        if ($this->isAbleToTranslate($number)) {
            return 'Answer';
        }
        return $this->translateUsingNextInterpreter($number, $previousTranslation);
    }

    private function isAbleToTranslate($number)
    {
        return ($number === 42);
    }
}
