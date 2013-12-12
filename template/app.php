<?php
require_once __DIR__ . '/bootstrap.php';

echo chr(27) . "[;H"; // go to top left
echo chr(27) . "[2J" ; // clear screen

echo '****************', PHP_EOL;
echo '*   THE APP    *', PHP_EOL;
echo '****************', PHP_EOL;
echo PHP_EOL, PHP_EOL;

echo (new HelloWorld())->sayHello();

echo PHP_EOL, PHP_EOL, PHP_EOL, PHP_EOL;
