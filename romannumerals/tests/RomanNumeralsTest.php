<?php

class RomanNumeralsTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->translator = new RomanNumeralsTranslator();
    }

    public function numberTranslations()
    {
        return [
            [1, 'I'],
            [2, 'II'],
            [3, 'III'],
            [4, 'IV'],
            [5, 'V'],
        ];
    }

    /**
     * @dataProvider numberTranslations
     */
    public function testArabicIsConvertedToRoman($arabic, $roman)
    {
        $this->assertEquals($roman, $this->translator->fromArabic($arabic));
    }
}
