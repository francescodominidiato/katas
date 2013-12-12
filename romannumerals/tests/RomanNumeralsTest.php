<?php

class RomanNumeralsTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->translator = new RomanNumeralsTranslator();
    }

    public function test1IsConvertedToI()
    {
        $this->assertEquals('I', $this->translator->fromArabic(1));
    }
    
    public function test2IsConvertedToII()
    {
        $this->assertEquals('II', $this->translator->fromArabic(2));
    }
    
    public function test3IsConvertedToIII()
    {
        $this->assertEquals('III', $this->translator->fromArabic(3));
    }
    
    public function test4IsConvertedToIV()
    {
        $this->assertEquals('IV', $this->translator->fromArabic(4));
    }
    
    

}
