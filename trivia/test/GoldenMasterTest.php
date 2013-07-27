<?php
require_once __DIR__ . '/../Game.php';

class GoldenMasterTest extends PHPUnit_Framework_TestCase
{
    public function testDeteministicOutputRespectsInitialCode()
    {
        $golden = file_get_contents(__DIR__ . "/fixtures/GoldenMaster.txt");
        ob_start();
        include __DIR__ . "/../GameRunner.php";
        $buffer = ob_get_contents(); 
        ob_end_clean();
        $this->assertEquals($golden, $buffer); 
    }

//    public function testPutPlayerInPenaltyBox()
//    {
//        $aGame = new Game();
//
//        //print_r($aGame->places);
//
//        $aGame->add("Chet");
//        $aGame->add("Pat");
//        $aGame->add("Sue");
//
//        //print_r($aGame->places);
//        srand($i);
//        do {
//            $aGame->roll(rand(1,6));
//
//            if (rand(0,9) == 7) {
//    }
}
