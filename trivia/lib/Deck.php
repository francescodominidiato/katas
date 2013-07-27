<?php

class Deck 
{
    private $category;
    private $numberOfCards = 0;
    private $pickedCards = 0;

    public function __construct(Category $category, $numberOfCards = 0)
    {
        $this->category = $category;
        $this->numberOfCards = $numberOfCards;
        $this->pickedCards = 0;
    }

    static public function of(Category $category)
    {
        $deck = new self($category, 50);
        return $deck;
    }

    public function pick()
    {
        if ($this->pickedCards < $this->numberOfCards) {
            return new Card($this->category, $this->pickedCards++);
        }
    }

    public function readTheQuestion()
    {
        return $this->pick()->readTheQuestion();
    }
}
