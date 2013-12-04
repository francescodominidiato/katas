<?php

class TestGameOfLife extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    public function testAMatrixCanBeExtendedFromCenter()
    {
        $matrix = new Matrix([
            [1, 0, 0],
            [0, 1, 1],
            [0, 0, 1],
        ]);
            
        
        echo PHP_EOL . PHP_EOL . $matrix->asString();
        $this->assertEquals([3, 3], $matrix->sizes());
        $matrix->extendFromCenterOf([1, 2]);
        $this->assertEquals([5, 7], $matrix->sizes());

        $extendedMatrixAsArray = [
            [0, 0, 0, 0, 0, 0, 0], 
            [0, 0, 1, 0, 0, 0, 0],
            [0, 0, 0, 1, 1, 0, 0],
            [0, 0, 0, 0, 1, 0, 0],
            [0, 0, 0, 0, 0, 0, 0], 
        ];
        $this->assertEquals($extendedMatrixAsArray, $matrix->asArray());


        echo PHP_EOL . PHP_EOL . $matrix->asString();
        
    }

    public function testShiftMatrixToLeft()
    {
        $matrix = new Matrix([
            [1, 0, 0],
            [0, 1, 1],
            [0, 0, 1],
        ]);
        $matrix->shift('left', 1);

        $shiftedMatrixAsArray = [
            [0, 0, 0],
            [1, 1, 0],
            [0, 1, 0],
        ];
        $this->assertEquals($shiftedMatrixAsArray, $matrix->asArray());
    }

    public function testShiftMatrixToRight()
    {
        $matrix = new Matrix([
            [1, 0, 0],
            [0, 1, 1],
            [0, 0, 1],
        ]);
        $matrix->shift('right', 1);

        $shiftedMatrixAsArray = [
            [0, 1, 0],
            [0, 0, 1],
            [0, 0, 0],
        ];
        $this->assertEquals($shiftedMatrixAsArray, $matrix->asArray());
    }

    public function testShiftMatrixToTop()
    {
        $matrix = new Matrix([
            [0, 1, 0, 0, 0],
            [0, 0, 1, 1, 0],
            [0, 0, 0, 1, 0],
        ]);
        $matrix->shift('top', 1);

        $shiftedMatrixAsArray = [
            [0, 0, 1, 1, 0],
            [0, 0, 0, 1, 0],
            [0, 0, 0, 0, 0],
        ];
        $this->assertEquals($shiftedMatrixAsArray, $matrix->asArray());
    }

    public function testShiftMatrixToBottom()
    {
        $matrix = new Matrix([
            [0, 1, 0, 0, 0],
            [0, 0, 1, 1, 0],
            [0, 0, 0, 1, 0],
        ]);
        $matrix->shift('bottom', 1);

        $shiftedMatrixAsArray = [
            [0, 0, 0, 0, 0],
            [0, 1, 0, 0, 0],
            [0, 0, 1, 1, 0],
        ];
        $this->assertEquals($shiftedMatrixAsArray, $matrix->asArray());
    }

    public function testSumValuesOfTwoMatrix()
    {
        $matrix1 = new Matrix([
            [1, 0, 0, 0],
            [0, 1, 1, 0],
            [0, 0, 1, 0],
        ]);

        $matrix2 = new Matrix([
            [2, 3, 0, 0],
            [0, 4, 0, 5],
            [0, 0, 0, 0],
        ]);

        $summedMatrixAsArray = [
            [3, 3, 0, 0],
            [0, 5, 1, 5],
            [0, 0, 1, 0],
        ];
        
        $this->assertEquals($summedMatrixAsArray, $matrix1->sumWith($matrix2)->asArray());
    }

    public function testCanEqualAMatrixToElement()
    {
        $matrix = new Matrix([
            [1, 3, 0],
            [0, 2, 3],
            [0, 5, 3],
        ]);

        $matchedMatrix = [
            [0, 1, 0],
            [0, 0, 1],
            [0, 0, 1],
        ];

        $this->assertEquals($matchedMatrix, $matrix->equalsTo(3)->asArray());
    }

    public function testLogicAnd()
    {
        $matrix1 = new Matrix([
            [0, 1, 0],
            [0, 0, 1],
            [0, 0, 1],
        ]);

        $matrix2 = new Matrix([
            [0, 1, 0],
            [0, 0, 0],
            [0, 1, 0],
        ]);

        $andMatrix = [
            [0, 1, 0],
            [0, 0, 0],
            [0, 0, 0],
        ];

        $this->assertEquals($andMatrix, $matrix1->logicAnd($matrix2)->asArray());

    }

    public function testLogicOr()
    {
        $matrix1 = new Matrix([
            [0, 1, 0],
            [0, 0, 1],
            [0, 0, 1],
        ]);

        $matrix2 = new Matrix([
            [0, 1, 0],
            [0, 0, 0],
            [0, 1, 0],
        ]);

        $orMatrix = [
            [0, 1, 0],
            [0, 0, 1],
            [0, 1, 1],
        ];

        $this->assertEquals($orMatrix, $matrix1->logicOr($matrix2)->asArray());
    }


    public function testTheGame()
    {
        $matrix = new Matrix([
            [1, 0, 0],
            [0, 1, 1],
            [0, 0, 1],
        ]);
        $matrix->extendFromCenterOf([1, 1]);

        $leftMatrix = $matrix->cloneAndShiftTo('left', 1);
        $rightMatrix = $matrix->cloneAndShiftTo('right', 1);
        
        $topLeftMatrix = $leftMatrix->cloneAndShiftTo('top', 1);
        $topRightMatrix = $rightMatrix->cloneAndShiftTo('top', 1);

        $bottomLeftMatrix = $leftMatrix->cloneAndShiftTo('bottom', 1);
        $bottomRightMatrix = $rightMatrix->cloneAndShiftTo('bottom', 1);

        $topMatrix = $matrix->cloneAndShiftTo('top', 1);
        $bottomMatrix = $matrix->cloneAndShiftTo('bottom', 1);

        $centerMatrix = clone $matrix;

        $summedAndExtendedMatrix = $centerMatrix
            ->sumWith($topLeftMatrix)
            ->sumWith($topMatrix)
            ->sumWith($topRightMatrix)
            ->sumWith($leftMatrix)
            ->sumWith($rightMatrix)
            ->sumWith($bottomLeftMatrix)
            ->sumWith($bottomMatrix)
            ->sumWith($bottomRightMatrix);

            
        $summedAndExtendedMatrixAsArray = [
            [1, 1, 1, 0, 0],
            [1, 2, 3, 2, 1],
            [1, 2, 4, 3, 2],
            [0, 1, 3, 3, 2],
            [0, 0, 1, 1, 1],
        ];

        $this->assertEquals($summedAndExtendedMatrixAsArray, $summedAndExtendedMatrix->asArray());

        $matrixWithThree = $summedAndExtendedMatrix->equalsTo(3);
        $matrixWithFour = $summedAndExtendedMatrix->equalsTo(4);
        $matrixWithFourOnlyWithLivedCells = $matrixWithFour->logicAnd($matrix);

        $nextGenerationMatrix = $matrixWithThree->logicOr($matrixWithFourOnlyWithLivedCells);

        echo PHP_EOL . PHP_EOL . $matrix->asString();
        echo PHP_EOL . PHP_EOL . $nextGenerationMatrix->asString();






    }

}

