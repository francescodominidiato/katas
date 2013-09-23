<?php

function fizzbuz($number)
{
    $map = array(
        3 => "fizz",
        5 => "buzz",
        7 => "woolf",
    );

    $output = "";
    foreach ($map as $divisor => $value) {
        $output .= ($number%$divisor == 0) ? $value : "";
    }

    return ($output != "") ? $output : $number;
}





function test() 
{
    assertEquals(2, 2);
    assertEquals(3, "fizz");
    assertEquals(6, "fizz");
    assertEquals(9, "fizz");
    assertEquals(5, "buzz");
    assertEquals(25, "buzz");
    assertEquals(50, "buzz");
    assertEquals(7, "woolf");
    assertEquals(28, "woolf");
    assertEquals(15, "fizzbuzz");
    assertEquals(30, "fizzbuzz");
    assertEquals(30, "fizzbuzz");
    assertEquals(21, "fizzwoolf");
    assertEquals(35, "buzzwoolf");
    assertEquals(105, "fizzbuzzwoolf");
    assertEquals(395640, "fizzbuzzwoolf");

    echo PHP_EOL;
}

function assertEquals($given, $expected)
{
    $output = fizzbuz($given);
    if ($output == $expected) {
        echo ".";
    } else {
        echo PHP_EOL . "ERROR: given {$given}, expected {$expected}, output {$output}" . PHP_EOL;
    }
}



function app()
{
    for ($i =1; $i <= 10000; $i++) {
        echo fizzbuz($i); 
        echo PHP_EOL;
    }
}

test();

//app();
