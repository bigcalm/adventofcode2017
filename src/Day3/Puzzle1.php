<?php

namespace Day3;

use PuzzleInterface;

class Puzzle1 implements PuzzleInterface {
    public $memoryMap = [];
    public $xMin = 0;
    public $yMin = 0;
    public $xMax = 0;
    public $yMax = 0;

    public function __construct( array $options = [] ) {
        // no options to manage
    }

    public function processInput( string $input ): int {
        $data = $this->parseString($input);

        $this->generateMemoryMap($data);
        $result = $this->calculateDistanceToLocation($data);

        return $result;
    }

    public function parseString(string $input): int
    {
        $data = (int)trim($input);

        return $data;
    }

    public function generateMemoryMap(int $targetLocation)
    {
        // reset the memory map
        $this->memoryMap = [];
        $this->memoryMap[0][0] = 1;
        $x = 0;
        $y = 0;

        for ($i = 2; $i <= $targetLocation; $i++) {
            $positionLeftSet = isset($this->memoryMap[$x - 1][$y]);
            $positionRightSet = isset($this->memoryMap[$x + 1][$y]);
            $positionAboveSet = isset($this->memoryMap[$x][$y - 1]);
            $positionBelowSet = isset($this->memoryMap[$x][$y + 1]);

            if (!$positionRightSet && !$positionAboveSet && !$positionLeftSet && !$positionBelowSet) {
                // starting position, move right (1 -> 2)
                $x++;

                $this->setMemoryLocation($x, $y, $i);
                continue;
            }

            if (!$positionRightSet && !$positionAboveSet && $positionLeftSet && !$positionBelowSet) {
                // stop moving right, move up (2 -> 3)
                $y--;

                $this->setMemoryLocation($x, $y, $i);
                continue;
            }

            if (!$positionRightSet && !$positionAboveSet && !$positionLeftSet && $positionBelowSet) {
                // stop moving up, move left (3 -> 4)
                $x--;

                $this->setMemoryLocation($x, $y, $i);
                continue;
            }


            if ($positionRightSet && !$positionAboveSet && !$positionLeftSet && $positionBelowSet) {
                // keep moving left (4 -> 5)
                $x--;

                $this->setMemoryLocation($x, $y, $i);
                continue;
            }

            if ($positionRightSet && !$positionAboveSet && !$positionLeftSet && !$positionBelowSet) {
                // stop moving left, move down (5 -> 6)
                $y++;

                $this->setMemoryLocation($x, $y, $i);
                continue;
            }

            if ($positionRightSet && $positionAboveSet && !$positionLeftSet && !$positionBelowSet) {
                // keep moving down (6 -> 7)
                $y++;

                $this->setMemoryLocation($x, $y, $i);
                continue;
            }

            if (!$positionRightSet && $positionAboveSet && !$positionLeftSet && !$positionBelowSet) {
                // stop moving down, move right (7 -> 8)
                $x++;

                $this->setMemoryLocation($x, $y, $i);
                continue;
            }

            if (!$positionRightSet && $positionAboveSet && $positionLeftSet && !$positionBelowSet) {
                // keep moving right (8 -> 9)
                $x++;

                $this->setMemoryLocation($x, $y, $i);
                continue;
            }

            if (!$positionRightSet && !$positionAboveSet && $positionLeftSet && $positionBelowSet) {
                // stop moving right, move up (10 -> 11)
                $y--;

                $this->setMemoryLocation($x, $y, $i);
                continue;
            }
        }
        $this->sortMemoryMapLocations();
    }

    public function setMemoryLocation(int $x, int $y, $value)
    {
//        echo "({$x},{$y}) = {$value}\n";

        if (!isset($this->memoryMap[$x])) {
            $this->memoryMap[$x] = [];
        }

        $this->memoryMap[$x][$y] = $value;

        if ($x < $this->xMin) {
            $this->xMin = $x;
        }
        if ($y < $this->yMin) {
            $this->yMin = $y;
        }
        if ($x > $this->xMax) {
            $this->xMax = $x;
        }
        if ($y > $this->yMax) {
            $this->yMax = $y;
        }
    }

    public function sortMemoryMapLocations()
    {
        ksort($this->memoryMap);

        foreach ($this->memoryMap as $x => $row) {
            ksort($this->memoryMap[$x]);
        }
    }

    public function calculateDistanceToLocation(int $targetLocation): int
    {
        $result = 0;

        for ($x = $this->xMin; $x <= $this->xMax; $x++) {
            for ($y = $this->yMin; $y <= $this->yMax; $y++) {
                if (isset($this->memoryMap[$x][$y]) && $this->memoryMap[$x][$y] == $targetLocation) {
                    $result = abs($x) + abs($y);
                    break 2;
                }
            }
        }

        return $result;
    }

    public function displayMemoryMap($type = 'value')
    {
        echo "\n";
        foreach ($this->memoryMap as $x => $row) {
            foreach ($row as $y => $location) {
                switch ($type) {
                    case 'both':
                        echo "({$x},{$y}){$location}\t";
                        break;

                    case 'cords':
                        echo "({$x},{$y})\t";
                        break;

                    case 'value':
                    default:
                        echo "{$location}\t";
                        break;
                }
            }
            echo "\n";
        }
    }
}
