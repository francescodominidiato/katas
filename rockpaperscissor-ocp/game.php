<?php
abstract class Shape
{
    protected $beatsMe = [];
    private $listOfNotWinningConditions = [
        'beatsMe',
        'isTheSame',    
    ];

    public function drawsAgainst(Shape $shape)
    {
        return $this->isTheSame($shape);
    }

    public function winsAgainst(Shape $shape)
    {
        foreach ($this->listOfNotWinningConditions as $method) {
            if ($this->$method($shape)) {
                return false;
            }
        } 
        return true;
    }
    
    private function beatsMe($shape)
    {
        return in_array(get_class($shape), $this->beatsMe);
    }
    
    private function isTheSame($shape)
    {
        return get_class($shape) === get_class($this);
    }
}

class Paper extends Shape
{
    protected $beatsMe = ['Scissors'];
}

class Rock extends Shape
{
    protected $beatsMe = ['Paper'];  
}

class Scissors extends Shape
{
    protected $beatsMe = ['Rock'];
}

class Lizard extends Shape
{
    protected $beatsMe = [
       'Scissors',
       'Rock',
    ];
}

class Player
{
    public function throws($shapeName) 
    {
        $className = ucfirst($shapeName);
        return new $className();
    }
}

class TestRockScissorPaper extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->playerA = new Player();
        $this->playerB = new Player();        
    }

    public function testPaperVsPaperDraws()
    {
        $shapeA = $this->playerA->throws('paper');
        $shapeB = $this->playerB->throws('paper');

        $this->assertTrue($shapeA->drawsAgainst($shapeB));
    }

    public function testPaperVsRockWins()
    {
        $shapeA = $this->playerA->throws('paper');
        $shapeB = $this->playerB->throws('rock');

        $this->assertTrue($shapeA->winsAgainst($shapeB));
    }

    public function testRockVsPaperLoses()
    {
        $shapeA = $this->playerA->throws('rock');
        $shapeB = $this->playerB->throws('paper');

        $this->assertFalse($shapeA->winsAgainst($shapeB));
    }

    public function testScissorsVsPaperWins()
    {
        $shapeA = $this->playerA->throws('scissors');
        $shapeB = $this->playerB->throws('paper');

        $this->assertTrue($shapeA->winsAgainst($shapeB));
    }

    public function testPaperVsScissorsLoses()
    {
        $shapeA = $this->playerA->throws('paper');
        $shapeB = $this->playerB->throws('scissors');

        $this->assertFalse($shapeA->winsAgainst($shapeB));
    }

    public function testRockVsScissorsWins()
    {
        $shapeA = $this->playerA->throws('rock');
        $shapeB = $this->playerB->throws('scissors');

        $this->assertTrue($shapeA->winsAgainst($shapeB), 'Rock vs Scissors cannot lose');
    }

    public function testScissorsVsRockLoses()
    {
        $shapeA = $this->playerA->throws('scissors');
        $shapeB = $this->playerB->throws('rock');

        $this->assertFalse($shapeA->winsAgainst($shapeB), 'Scissors should lose against rock');

    }

    public function testPapersVsPaperDoesNotWin()
    {
        $shapeA = $this->playerA->throws('paper');
        $shapeB = $this->playerB->throws('paper');

        $this->assertFalse($shapeA->winsAgainst($shapeB), 'Paper should not win against paper');

    }

    public function testScissorsVsLizardWins()
    {
        $shapeA = $this->playerA->throws('scissors');
        $shapeB = $this->playerB->throws('lizard');

        $this->assertTrue($shapeA->winsAgainst($shapeB));
    }

    public function testLizardVsScissorsLoses()
    {
        $shapeA = $this->playerA->throws('lizard');
        $shapeB = $this->playerB->throws('scissors');

        $this->assertFalse($shapeA->winsAgainst($shapeB));
    }

    public function testLizardVsRockLoses()
    {
        $shapeA = $this->playerA->throws('lizard');
        $shapeB = $this->playerB->throws('rock');

        $this->assertFalse($shapeA->winsAgainst($shapeB));
    }
}
