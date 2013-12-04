<?php

require_once 'lib.php';

// $start = (new Matrix([
//     [1, 1, 1],
//     [1, 0, 0],
//     [0, 1, 0],
// ]))->extendFromCenterOf([30, 30]);
$start = (new Matrix([
    [0, 0, 1, 0, 1, 0, 1, 1],
    [1, 0, 1, 0, 1, 1, 0, 0],
    [1, 0, 1, 0, 1, 0, 1, 0],
    [1, 0, 1, 0, 1, 0, 1, 1],
    [1, 0, 1, 1, 1, 0, 1, 1],
    [1, 0, 1, 1, 1, 0, 1, 1],
    [0, 0, 1, 1, 1, 0, 1, 0],
]))->extendFromCenterOf([10, 10]);


print chr(27) . "[;H"; // go to top left
print chr(27) . "[2J" ; // clear screen

$game = new GameOfLife($start);

echo $start->asGrid();

while(true) {
    print chr(27) . "[;H"; // go to top left
    print chr(27) . "[2J" ; // clear screen
    echo $game->evolve()->asGrid();
    usleep(300000);
}

