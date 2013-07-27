<?php
require_once __DIR__ . '/../Game.php';

class PlayerTest extends PHPUnit_Framework_TestCase
{
    public function testCanMoveAPlayerToASpecifiedPPlace()
    {
        $place = new Place(10, Deck::of(new Category("Pop")));
        $player = new Player("Bob");
        $player->moveToPlace($place);
        $this->assertTrue($player->isInPlace($place));



    }
    // public function testPicking1CardFromTheDeckThenRemain49Cardrs()
    // {
    //    $deck = Deck::of(new Category("Pop"));
    //    $card = $deck->pick();
    //    $this->assertInstanceOf('Card', $card);

    //    $cardsToPeack = 49;
    //    while ($deck->pick() instanceof Card) {
    //        $cardsToPeack--;
    //    }

    //    $this->assertEquals(0, $cardsToPeack);
    // }

    // public function testGivenCardCanReadTheQuestion()
    // {
    //     $card = new Card(new Category("Pop"), 0);
    //     $this->assertEquals("Pop Question 0", $card->readTheQuestion());
    // }

    // public function testGivenDeckCanPickAndReadQuestionsInSequence()
    // {
    //     // il mazzo deve avere la categoria perche le domande decrementano percategoria
    //     // il mazzo e le carde sono un aggregate
    //     //
    //     $deck = Deck::of(new Category("Pop"));
    //     $this->assertEquals("Pop Question 0", $deck->readTheQuestion());
    //     $this->assertEquals("Pop Question 1", $deck->readTheQuestion());
    //     $this->assertEquals("Pop Question 2", $deck->readTheQuestion());
    //     $this->assertEquals("Pop Question 3", $deck->readTheQuestion());
    // }
}
