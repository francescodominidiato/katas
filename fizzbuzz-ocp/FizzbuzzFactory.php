<?php

require_once __DIR__ . '/Fizzbuzz.php';
require_once __DIR__ . '/Interpreter.php';
require_once __DIR__ . '/ChainableInterpreter.php';
require_once __DIR__ . '/NoMoreInterpreter.php';
require_once __DIR__ . '/DefaultInterpreter.php';
require_once __DIR__ . '/MultipleOfIntegerInterpreter.php';
require_once __DIR__ . '/FortytwoInterpreter.php';

class FizzbuzzFactory
{
    public static function create()
    {
        return new Fizzbuzz(
            new FortytwoInterpreter(),
            new MultipleOfIntegerInterpreter(3, 'Fizz'),
            new MultipleOfIntegerInterpreter(5, 'Buzz'),
            new MultipleOfIntegerInterpreter(7, 'Bang'),
            new DefaultInterpreter()
        );
    }
}
