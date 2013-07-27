<?php

require_once __DIR__ . '/Game.php';

for ($i=1; $i<=100; $i++) {
    $notAWinner;

    $aGame = new Game();


    $aGame->add("Chet");
    $aGame->add("Pat");
    $aGame->add("Sue");

    var_dump($aGame->players);
    srand($i);
    do {
        $aGame->roll(rand(1,6));

        if (rand(0,9) == 7) {
            $notAWinner = $aGame->wrongAnswer();
        } else {
            $notAWinner = $aGame->wasCorrectlyAnswered();
        }

        print_r($aGame->palyers);
    } while ($notAWinner);
}
