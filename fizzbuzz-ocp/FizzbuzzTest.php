<?php

require_once __DIR__ . '/FizzbuzzFactory.php';

class FizzbuzzTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldSayTheNumber()
    {
        $fizzbuzz = FizzbuzzFactory::create();
        $this->assertEquals("1", $fizzbuzz->say(1));
        $this->assertEquals("2", $fizzbuzz->say(2));
    }

    public function testPassingAMultipleOfThreeSayFizz()
    {
        $fizzbuzz = FizzbuzzFactory::create();
        $this->assertEquals("Fizz", $fizzbuzz->say(3));
        $this->assertEquals("Fizz", $fizzbuzz->say(3*2));
    }

    public function testPassingAMultipleOfFiveSaysBuzz()
    {
        $fizzbuzz = FizzbuzzFactory::create();
        $this->assertEquals("Buzz", $fizzbuzz->say(5));
        $this->assertEquals("Buzz", $fizzbuzz->say(5*2));
    }

    public function testPassingAMultipleOfFifteenSaysFizzBuzz()
    {
        $fizzbuzz = FizzbuzzFactory::create();
        $this->assertEquals("FizzBuzz", $fizzbuzz->say(15));
        $this->assertEquals("FizzBuzz", $fizzbuzz->say(15*2));
    }
    
    public function testPassingAMultipleOfSevenSaysBang()
    {
        $fizzbuzz = FizzbuzzFactory::create();
        $this->assertEquals("Bang", $fizzbuzz->say(7));
        $this->assertEquals("Bang", $fizzbuzz->say(7*2));
        $this->assertEquals("FizzBuzzBang", $fizzbuzz->say(3*5*7));
    }

    public function testPassingAMultipleOfThreeFiveAndSevenSaysFizzBuzzBang()
    {
        $fizzbuzz = FizzbuzzFactory::create();
        $this->assertEquals("FizzBuzzBang", $fizzbuzz->say(3*5*7));
    }

    public function testPassingFortyTwoSaysAnswer()
    {
        $fizzbuzz = FizzbuzzFactory::create();
        $this->assertEquals("Answer", $fizzbuzz->say(42));
        $this->assertNotEquals("Answer", $fizzbuzz->say(42*2));
    }
}
