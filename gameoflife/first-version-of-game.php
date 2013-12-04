<?php


class Cell
{
    private $state;
    private $neighbours;

    public function __construct($initialState)
    {
        $this->state = $initialState;
    }

    public function neighboursAre(array $neighbours)
    {
        $this->neighbours = $neighbours;
    }

    public function isAlive()
    {
        return ($this->state == 'alive');
    }

    public function isDead()
    {
        return !$this->isAlive();
    }

    public function evolves()
    {
        $aliveNeighbours = $this->countAliveNeighbours();

        if ($this->isAlive() and ($aliveNeighbours < 2 or $aliveNeighbours > 3)) {
            $this->state = 'dead';
        } elseif ($this->isDead() and $aliveNeighbours === 3) {
            $this->state = 'alive';
        }
    }

    private function countAliveNeighbours()
    {
        $neighboursAlive = 0;
        foreach ($this->neighbours as $neighbour) {
            if ($neighbour->isAlive()) {
                $neighboursAlive++;
            }
        }

        return $neighboursAlive;
    }



}






class TestGameOfLife extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    public function testAnAliveCellIsNotDead()
    {
        $cell = new Cell('alive');

        $this->assertFalse($cell->isDead());
        $this->assertTrue($cell->isAlive());
    }


    public function testAnyLiveCellWithFewerThanTwoLiveNeighboursDies()
    {
        $cell = new Cell('alive');
        $cell->neighboursAre($this->groupOf8NeighboursOfWhichAlive(0));
        $cell->evolves();
        $this->assertTrue($cell->isDead());

        $cell = new Cell('alive');
        $cell->neighboursAre($this->groupOf8NeighboursOfWhichAlive(0));
        $cell->evolves();
        $this->assertTrue($cell->isDead());
    }

    public function testAnyLiveCellWithTwoOrThreeLiveNeighboursLives()
    {
        $cell = new Cell('alive');
        $cell->neighboursAre($this->groupOf8NeighboursOfWhichAlive(2));
        $cell->evolves();
        $this->assertTrue($cell->isAlive());

        $cell = new Cell('alive');
        $cell->neighboursAre($this->groupOf8NeighboursOfWhichAlive(3));
        $cell->evolves();
        $this->assertTrue($cell->isAlive());
    }

    public function testAnyLiveCellWithMoreThanThreeLiveNeighboursDies()
    {
        $cell = new Cell('alive');
        $cell->neighboursAre($this->groupOf8NeighboursOfWhichAlive(4));
        $cell->evolves();
        $this->assertTrue($cell->isDead());

        $cell = new Cell('alive');
        $cell->neighboursAre($this->groupOf8NeighboursOfWhichAlive(8));
        $cell->evolves();
        $this->assertTrue($cell->isDead());

    }

    public function testAnyDeadCellWithExactlyThreeLiveNeighboursBecomesALiveCell()
    {
        $cell = new Cell('dead');
        $cell->neighboursAre($this->groupOf8NeighboursOfWhichAlive(3));
        $cell->evolves();
        $this->assertTrue($cell->isAlive());

        $cell = new Cell('dead');
        $cell->neighboursAre($this->groupOf8NeighboursOfWhichAlive(2));
        $cell->evolves();
        $this->assertTrue($cell->isDead());
    }


    private function groupOf8NeighboursOfWhichAlive($numberOfNeighboursAlive = 0)
    {
        $neighbours = [];
        for ($i = 0; $i < 8; $i ++) {
            if ($i < $numberOfNeighboursAlive) {
                $neighbours[] = new Cell('alive');
            } else {
                $neighbours[] = new Cell('dead');
            }
        }
        return $neighbours;
    }






}
