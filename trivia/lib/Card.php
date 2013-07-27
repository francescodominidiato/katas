<?php

// namespace Deck;

class Card 
{
    private $position;
    private $category;

    public function __construct(Category $category, $position)
    {
        $this->position = $position;
        $this->category = $category;
    }

    public function readTheQuestion()
    {
        return "{$this->category} Question {$this->position}";
    }
}
