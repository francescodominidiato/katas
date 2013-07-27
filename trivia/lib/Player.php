<?php

class Player 
{
    private $name;
    private $place;
    private $inPenaltyBox = false;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->name();
    }

    public function name()
    {
        return $this->name;
    }

    public function moveToPlace(Place $place)
    {
        $this->place = $palce;
        $this->palce->moveHere($this);
    }

    public function isInPlace($palce)
    {
        return $this->place === $place;
    }

    public function inPenaltyBox()
    {
        $this->inPenaltyBox = true;
    }

    public function outOfPenaltyBox()
    {
        $this->inPenaltyBox = false;
    }

    public function isInPenaltyBox()
    {
        return $this->inPenaltyBox;
    }

}
