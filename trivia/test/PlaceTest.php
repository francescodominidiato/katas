<?php
require_once __DIR__ . '/../Game.php';

class PlaceTest extends PHPUnit_Framework_TestCase
{
    public function testAssigningADeckTo2PlacesTheQuestionAreReadInSequence()
    {
        $deck = Deck::of(new Category("Pop"));
        $place1 = new Place(1, $deck);
        $place2 = new Place(2, $deck);

        $this->assertEquals("Pop Question 0", $place1->readTheQuestionFromDeck());
        $this->assertEquals("Pop Question 1", $place1->readTheQuestionFromDeck());
        $this->assertEquals("Pop Question 2", $place2->readTheQuestionFromDeck());
        $this->assertEquals("Pop Question 3", $place1->readTheQuestionFromDeck());
    }

    public function testThePlaceCanContainAPlayer()
    {
        $deck = Deck::of(new Category("foo"));
        $palce = new Place(1, $deck);
        $john = new Player("John");
        $this->assertFalse($palce->isHere($john));
        $palce->moveHere($john);
        $this->assertTrue($palce->isHere($john));
    }

    public function testAPlayerCanGoAwayFromAPalace()
    {
        $palce = new Place(1, Deck::of(new Category("foo")));
        $john = new Player("John");
        $palce->moveHere($john);
        $this->assertTrue($palce->isHere($john));
        $palce->moveAwayFromHere($john);
        $this->assertFalse($palce->isHere($john));
    }

    public function testAPlaceCanContainMorePlayers()
    {
        $palce = new Place(1, Deck::of(new Category("foo")));
        $john = new Player("John");
        $paul = new Player("Paul");
        $ringo = new Player("Ringo");

        $palce->moveHere($john);
        $palce->moveHere($paul);
        $palce->moveHere($ringo);
        $this->assertTrue($palce->isHere($john));
        $this->assertTrue($palce->isHere($paul));
        $this->assertTrue($palce->isHere($ringo));
        
        $palce->moveAwayFromHere($john);
        $this->assertFalse($palce->isHere($john));
        $this->assertTrue($palce->isHere($paul));
        $this->assertTrue($palce->isHere($ringo));
    }


}
