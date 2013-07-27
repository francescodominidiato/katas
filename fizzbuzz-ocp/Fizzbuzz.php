<?php

class Fizzbuzz
{
    private $interpreter;

    public function __construct(/* list of interpreters, */ Interpreter $defaultInterpreter)
    {
        $interpreters = func_get_args();
        $defaultInterpreter = array_pop($interpreters);
        $this->interpreter = $defaultInterpreter;

        $chainableInterpreters = array_reverse($interpreters);
        
        foreach($chainableInterpreters as $interpreter) {
            $interpreter->nextInterpreterIs($this->interpreter);
            $this->interpreter = $interpreter;
        }
    }

    public function say($number)
    {
        return $this->interpreter->translate($number);
    }
}
