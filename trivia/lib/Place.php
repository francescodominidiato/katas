<?php

class Place 
{
    private $cellNumber;
    private $deck;
    private $players = array();

    public function __construct($cellNumber, Deck $deck)
    {
        $this->cellNumber = $cellNumber;
        $this->deck = $deck;
    }

    public function __toString()
    {
        return $this->cellNumber;
    }

    public function moveHere(Player $player)
    {
        $this->players[$player->name()] = $player;
    }

    public function moveAwayFromHere(Player $player)
    {
        unset($this->players[$player->name()]);
    }

    public function isHere(Player $player)
    {
        return (bool)array_search($player, $this->players);
    }

    public function category()
    {
        return $this->deck->category();
    }

    public function readTheQuestionFromDeck()
    {
        return $this->deck->readTheQuestion();
    }
}
