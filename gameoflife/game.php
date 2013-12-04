<?php
class Cell
{
    private $x;
    private $y;
    private $isAlive;

    public function __construct($x, $y, $isAlive=false)
    {
        $this->x = $x;
        $this->y = $y;
        $this->isAlive = $isAlive;
    }

    public function isAlive()
    {
        return (bool)$this->isAlive;
    }

    public function isDead()
    {
        return !$this->isAlive();
    }

    public function position()
    {
        return "{$this->x}:{$this->y}";
    }

    public function evolves()
    {
    }




}









class TestGameOfLife extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    public function testAnAliveCellIsNotDead()
    {
        $cell = new Cell(0, 0, $isAlive = true);

        $this->assertFalse($cell->isDead());
        $this->assertTrue($cell->isAlive());
    }

    public function testCellCanExportItsPosition()
    {
        $cell = new Cell(0, 0);
        $this->assertEquals("0:0", $cell->position());
    }
}
