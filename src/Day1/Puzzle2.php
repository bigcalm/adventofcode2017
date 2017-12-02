<?php

namespace Day1;

use PuzzleInterface;

class Puzzle2 extends Puzzle1 implements PuzzleInterface
{
    public function getNextInSequence(array $data, int $index): int
    {
        $dataCount = count($data);
        $jump      = $dataCount / 2;

        // At the end of the array? Loop back to the beginning
        if ($index + $jump < $dataCount) {
            $nextIndex = $index + $jump;
        } else {
            $toEndOfArray = $dataCount - $index;
            $nextIndex    = $jump - $toEndOfArray;
        }

        $nextInSequence = $data[$nextIndex];

        return $nextInSequence;
    }
}
