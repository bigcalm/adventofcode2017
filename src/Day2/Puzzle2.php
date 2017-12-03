<?php

namespace Day2;

use PuzzleInterface;

class Puzzle2 extends Puzzle1 implements PuzzleInterface
{
    public function processInput(string $input): int
    {
        $data = $this->parseString($input);

        $result = $this->getSumOfAllDivisionResults($data);

        return $result;
    }

    public function isDivisibleWithNoRemainder(int $value1, int $value2): bool
    {
        return $value1 % $value2 === 0;
    }

    public function divide(int $value1, int $value2): int
    {
        return $value1 / $value2;
    }

    public function getDivisiblePair(array $row): array
    {
        $divisiblePair = [];

        $rowCount = count($row);

        for ($i = 0; $i < $rowCount; $i++) {
            for ($j = 0; $j < $rowCount; $j++) {
                if ($i == $j) {
                    continue;
                }

                if ($this->isDivisibleWithNoRemainder($row[$i], $row[$j])) {
                    $divisiblePair = [(int)$row[$i], (int)$row[$j]];
                    return $divisiblePair;
                }
            }
        }

        return $divisiblePair;
    }

    public function getDivisionOfDivisiblePairIn(array $row): int
    {
        $divisiblePair = $this->getDivisiblePair($row);

        $divisionResult = $this->divide($divisiblePair[0], $divisiblePair[1]);

        return $divisionResult;
    }

    public function getSumOfAllDivisionResults(array $rows): int
    {
        $result = 0;

        foreach ($rows as $row) {
            $result += $this->getDivisionOfDivisiblePairIn($row);
        }

        return $result;
    }
}
