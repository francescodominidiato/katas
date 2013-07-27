<?php
class Board
{
    private $places = array();

    public function __construct()
    {
        $categories = array(
            "Pop",
            "Science",
            "Sports",
            "Rock",
        );
        $i = 0;
        foreach ($categories as $category) {
            $deck = Deck::of(new Category($category));
            
            $this->places[$i] = new Place($i, $deck);
            $this->places[$i+4] = new Place($i+4, $deck);
            $this->places[$i+8] = new Place($i+8, $deck);
            $i++;
        }
    }

}
