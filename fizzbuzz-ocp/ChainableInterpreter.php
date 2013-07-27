<?php 

abstract class ChainableInterpreter implements interpreter
{
    protected $nextInterpreter;

    public function nextInterpreterIs(Interpreter $interpreter)
    {
        $this->nextInterpreter = $interpreter;
    }
    
    protected function translateUsingNextInterpreter($number, $previousTranslation)
    {
        $interpreter = $this->nextInterpreter ?: new NoMoreInterpreter();
        return $interpreter->translate($number, $previousTranslation);
    }
}
