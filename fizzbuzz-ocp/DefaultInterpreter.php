<?php

class DefaultInterpreter implements Interpreter 
{
    public function translate($number, $previousTranslation='')
    {
        return $this->thereIsNot($previousTranslation) ? $number : $previousTranslation;
    }

    private function thereIsNot($previousTranslation)
    {
        return !(bool)strlen($previousTranslation);
    }
}
