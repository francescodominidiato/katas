<?php

class RomanNumeralsTest extends PHPUnit_Framework_TestCase
{
    public function test1IsConvertedToI()
    {
        $rmTranslator = new RomanNumeralsTranslator();
        
        $this->assertEquals('I', $rmTranslator->fromArabic(1));

    }
    
    public function test2IsConvertedToII()
    {
        $rmTranslator = new RomanNumeralsTranslator();
        
        $this->assertEquals('II', $rmTranslator->fromArabic(2));

    }
    
    

}
