<?php

class HelloWorldTest extends PHPUnit_Framework_TestCase
{
    public function testItWorks()
    {
        $this->assertTrue(true);
    }

    public function testSayHello()
    {
        $helloWorld = new HelloWorld();
        $this->assertEquals('Hello World!', $helloWorld->sayHello());
    }
}
