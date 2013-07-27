<?php

require_once __DIR__ . "/lib/Category.php";
require_once __DIR__ . "/lib/Deck.php";
require_once __DIR__ . "/lib/Card.php";
require_once __DIR__ . "/lib/Player.php";
require_once __DIR__ . "/lib/Board.php";
require_once __DIR__ . "/lib/Place.php";

function echoln($string) {
    echo $string."\n";
}

class Game 
{
    public $players;
    public $places;
    public $purses;

    public $currentPlayer = 0;
    public $isGettingOutOfPenaltyBox;

    private $board;


    public function __construct()
    {
        $this->players = array();
        $this->places = array();
        $this->purses  = array(0);

        $this->placesNew = array();

        $this->takeTheDecksOutOfTheBox();
    }

    private function takeTheDecksOutOfTheBox()
    {
        $this->board = new Board();


        $categories = array(
            "Pop",
            "Science",
            "Sports",
            "Rock",
        );
        $i = 0;
        foreach ($categories as $category) {
            $deck = Deck::of(new Category($category));
            
            $this->placesNew[$i] = new Place($i, $deck);
            $this->placesNew[$i+4] = new Place($i+4, $deck);
            $this->placesNew[$i+8] = new Place($i+8, $deck);
            $i++;
        }
        
    }

    public function askQuestion()
    {
        // var_dump("current player");
        // var_dump($this->currentPlayer);
        // var_dump($this->currentPlayer());
        // var_dump($this->placeOf($this->currentPlayer()));

        $question = $this->placeOf($this->currentPlayer())->readTheQuestionFromDeck();
        echoln($question);
    }

    private function currentCategory()
    {
        if ($this->places[$this->currentPlayer] == 0) return "Pop";
        if ($this->places[$this->currentPlayer] == 1) return "Science";
        if ($this->places[$this->currentPlayer] == 2) return "Sports";
        if ($this->places[$this->currentPlayer] == 3) return "Rock";

        if ($this->places[$this->currentPlayer] == 4) return "Pop";
        if ($this->places[$this->currentPlayer] == 5) return "Science";
        if ($this->places[$this->currentPlayer] == 6) return "Sports";
        if ($this->places[$this->currentPlayer] == 7) return "Rock";

        if ($this->places[$this->currentPlayer] == 8) return "Pop";
        if ($this->places[$this->currentPlayer] == 9) return "Science";
        if ($this->places[$this->currentPlayer] == 10) return "Sports";
        if ($this->places[$this->currentPlayer] == 11) return "Rock";
    }

    public function isPlayable()
    {
        return ($this->howManyPlayers() >= 2);
    }

    public function add($playerName)
    {
        $player = new Player($playerName);
        array_push($this->players, $player);

        echoln($playerName . " was added");
        echoln("They are player number " . $this->howManyPlayers());
    }

    public function howManyPlayers()
    {
        return count($this->players);
    }

    public function roll($dice)
    {
        echoln($this->currentPlayer() . " is the current player");
        echoln("They have rolled a " . $dice);

        $this->moveCurrentUsersAheadOf($dice);
        if ($this->currentPalyerIsInPenaltyBox()) {
            $this->inPenaltyActions($dice);
        } else {
            $this->normalAction($dice);
        }
    }

    private function  moveCurrentUsersAheadOf($palces)
    {
    }

    private function currentPlayer()
    {
        return $this->players[$this->currentPlayer];
    }

    private function placeOf(Player $player)
    {
        // var_dump($this->players);
        // var_dump($this->places);
        // var_dump($this->placesNew);

        $currentPlayerKey = array_search($player, $this->players);
        return $this->placesNew[$this->places[$currentPlayerKey]];
    }

    private function currentPalyerIsInPenaltyBox() 
    {
        return $this->currentPlayer()->isInPenaltyBox();
    }

    private function inPenaltyActions($dice)
    {
        if ($dice % 2 != 0) {
            $this->isGettingOutOfPenaltyBox = true;
            echoln($this->currentPlayer() . " is getting out of the penalty box");

            $this->normalAction($dice);
        } else {
            echoln($this->currentPlayer() . " is not getting out of the penalty box");
            $this->isGettingOutOfPenaltyBox = false;
        }
    }

    private function normalAction($positions)
    {
        $this->places[$this->currentPlayer] = $this->places[$this->currentPlayer] + $positions;
        if ($this->places[$this->currentPlayer] > 11) {
            $this->places[$this->currentPlayer] = $this->places[$this->currentPlayer] - 12;
        }

        $this->currentPlayer()->moveToPlace($this->placesNew[$this->places[$this->currentPlayer]]);

        echoln($this->currentPlayer()
        . "'s new location is "
        .$this->places[$this->currentPlayer]);
        echoln("The category is " . $this->currentCategory());
        $this->askQuestion();
    }


    public function wasCorrectlyAnswered()
    {
        if ($this->currentPalyerIsInPenaltyBox()){
            if ($this->isGettingOutOfPenaltyBox) {
                echoln("Answer was correct!!!!");
                $this->purses[$this->currentPlayer]++;
                echoln($this->currentPlayer()
                . " now has "
                .$this->purses[$this->currentPlayer]
                . " Gold Coins.");

                $winner = $this->didPlayerWin();
                $this->passToTheNextPalyer();

                return $winner;
            } else {
                $this->passToTheNextPalyer();
                return true;
            }
        } else {
            echoln("Answer was corrent!!!!");
            $this->purses[$this->currentPlayer]++;
            echoln($this->currentPlayer()
            . " now has "
            .$this->purses[$this->currentPlayer]
            . " Gold Coins.");

            $winner = $this->didPlayerWin();
            $this->passToTheNextPalyer();

            return $winner;
        }
    }

    private function passToTheNextPalyer()
    {
        $this->currentPlayer++;
        if ($this->currentPlayer == $this->howManyPlayers()) $this->currentPlayer = 0;
    }

    public function wrongAnswer()
    {
        echoln("Question was incorrectly answered");
        echoln($this->currentPlayer() . " was sent to the penalty box");
        $this->currentPlayer()->inPenaltyBox();

        $this->passToTheNextPalyer();
        return true;
    }

    public function didPlayerWin()
    {
        return !($this->purses[$this->currentPlayer] == 6);
    }
}
