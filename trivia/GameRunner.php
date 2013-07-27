<?php

require_once __DIR__ . '/Game.php';

for ($i=1; $i<=100; $i++) {
    $notAWinner;

    $aGame = new Game();

    //print_r($aGame->places);

    $aGame->add("Chet");
    $aGame->add("Pat");
    $aGame->add("Sue");

    //print_r($aGame->places);
    srand($i);
    do {
        $aGame->roll(rand(1,6));

        if (rand(0,9) == 7) {
            $notAWinner = $aGame->wrongAnswer();
        } else {
            $notAWinner = $aGame->wasCorrectlyAnswered();
        }

        //print_r($aGame->places);
    } while ($notAWinner);
}
