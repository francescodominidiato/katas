<?php

class Matrix
{
    private $matrix;

    public function __construct(array $matrix)
    {
        $this->matrix = $matrix;
    }

    public static function withSizes(array $sizes)
    {
        $matrix = array_fill(0, $sizes[0], array_fill(0, $sizes[1], 0));
        return new self($matrix);
    }

    public function sizes()
    {
        return [sizeof($this->matrix), sizeof($this->matrix[0])];
    }

    public function extendFromCenterOf(array $extension)
    {
        $sizes = $this->sizes();
        $yExtension = $extension[0];
        $xExtension = $extension[1];

        for ($i=0; $i<$yExtension; $i++) {
            array_unshift($this->matrix, array_fill(0, $sizes[1], 0)); 
            array_push($this->matrix, array_fill(0, $sizes[1], 0)); 
        }
        $this->matrix = array_map(
            function($row) use($xExtension) {
                for ($i=0; $i<$xExtension; $i++) {
                    array_unshift($row, 0); 
                    array_push($row, 0); 
                }
                return $row;
            }, 
            $this->matrix
        );
        return $this;
    }

    public function shift($to, $of)
    {
        if ($to == 'left') {
            $this->matrix = array_map(
                function($row) use($of) {
                    for ($i=0; $i<$of; $i++) {
                        array_shift($row); 
                        array_push($row, 0); 
                    }
                    return $row;
                }, 
                $this->matrix
            );
        }
        
        if ($to == 'right') {
            $this->matrix = array_map(
                function($row) use($of) {
                    for ($i=0; $i<$of; $i++) {
                        array_unshift($row, 0); 
                        array_pop($row); 
                    }
                    return $row;
                }, 
                $this->matrix
            );
        }
        

        if ($to == 'top') {
            $sizes = $this->sizes();
            for ($i=0; $i<$of; $i++) {
                array_shift($this->matrix); 
                array_push($this->matrix, array_fill(0, $sizes[1], 0)); 
            }
        }
        
        if ($to == 'bottom') {
            $sizes = $this->sizes();
            for ($i=0; $i<$of; $i++) {
                array_unshift($this->matrix, array_fill(0, $sizes[1], 0)); 
                array_pop($this->matrix); 
            }
        }
        
        return $this;
    }

    public function cloneAndShiftTo($to, $of = 1)
    {
        $matrix = clone $this;
        return $matrix->shift($to, $of);
    }

    public function sumWith(Matrix $matrix)
    {
        $arrayToAdd = $matrix->asArray();
        $sizes = $this->sizes;
        foreach ($this->matrix as $x => $row) {
            foreach ($row as $y => $cell) {
                $this->matrix[$x][$y] += $arrayToAdd[$x][$y];
            }
        }

        return $this;
    }

    public function equalsTo($value)
    {
        $matchedArray = $this->matrix;
        foreach ($this->matrix as $x => $row) {
            foreach ($row as $y => $cell) {
                $matchedArray[$x][$y] = ($cell == $value) ? 1 : 0;
            }
        }

        return new self($matchedArray);
    }

    public function logicAnd(Matrix $matrix)
    {
        $arrayToCompare = $matrix->asArray();
        $andArray = $this->matrix;
        foreach ($this->matrix as $x => $row) {
            foreach ($row as $y => $cell) {
                $andArray[$x][$y] = ($cell && $arrayToCompare[$x][$y]) ? 1 : 0;
            }
        }

        return new self($andArray);
    }

    public function logicOr(Matrix $matrix)
    {
        $arrayToCompare = $matrix->asArray();
        $orArray = $this->matrix;
        foreach ($this->matrix as $x => $row) {
            foreach ($row as $y => $cell) {
                $orArray[$x][$y] = ($cell || $arrayToCompare[$x][$y]) ? 1 : 0;
            }
        }

        return new self($orArray);
    }

    public function asArray()
    {
        return $this->matrix;
    }

    public function asString()
    {
        $output = '';
        foreach($this->matrix as $row) {
            foreach ($row as $cell) {
                $output .= $cell;
            }
            $output .= PHP_EOL;
        }
        return $output;
    }

    public function asGrid()
    {
        $output = '';
        foreach($this->matrix as $row) {
            foreach ($row as $cell) {
                $output .= ($cell) ? " " : "█";
            }
            $output .= PHP_EOL;
        }
        return $output;
    }

}




class GameOfLife
{
    private $matrix;

    public function __construct(Matrix $start)
    {
        //$start->extendFromCenterOf([1, 1]);
        $this->matrix = $start;
    }

    public function evolve()
    {
        $matrix = $this->matrix;

        $leftMatrix = $matrix->cloneAndShiftTo('left');
        $rightMatrix = $matrix->cloneAndShiftTo('right');
        
        $topLeftMatrix = $leftMatrix->cloneAndShiftTo('top');
        $topRightMatrix = $rightMatrix->cloneAndShiftTo('top');

        $bottomLeftMatrix = $leftMatrix->cloneAndShiftTo('bottom');
        $bottomRightMatrix = $rightMatrix->cloneAndShiftTo('bottom');

        $topMatrix = $matrix->cloneAndShiftTo('top');
        $bottomMatrix = $matrix->cloneAndShiftTo('bottom');

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

        $matrixWithThree = $summedAndExtendedMatrix->equalsTo(3);
        $matrixWithFour = $summedAndExtendedMatrix->equalsTo(4);
        $matrixWithFourOnlyWithLivedCells = $matrixWithFour->logicAnd($matrix);

        $nextGenerationMatrix = $matrixWithThree->logicOr($matrixWithFourOnlyWithLivedCells);

        $this->matrix = $nextGenerationMatrix;

        return $this->matrix;
    }
}




