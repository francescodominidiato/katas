<?php

class NoMoreInterpreter implements Interpreter
{
    public function translate($number, $previousTranslation='')
    {
        return $previousTranslation;
    }
}
