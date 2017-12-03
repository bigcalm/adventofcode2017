<?php

namespace Day2;

use PuzzleInterface;

class Puzzle1 implements PuzzleInterface
{
    public function __construct(array $options = [])
    {
        // no options to manage
    }

    public function processInput(string $input): int
    {
        $data = $this->parseString($input);

        $result = $this->getSpredsheetChecksum($data);

        return $result;
    }

    public function parseString(string $input): array
    {
        $data = [];

        $rows = explode("\n", $input);

        for ($i = 0; $i < count($rows); $i++) {
            if (empty($rows[$i])) {
                continue;
            }

            $data[$i] = preg_split("/\s+/", $rows[$i]);
        }

        return $data;
    }

    public function getExtremeValues(array $values): array
    {
        $min = (int)min($values);
        $max = (int)max($values);

        return ['min' => $min, 'max' => $max];
    }

    public function getRowChecksum(array $row): int
    {
        $extremeValues = $this->getExtremeValues($row);

        $checksum = $extremeValues['max'] - $extremeValues['min'];

        return $checksum;
    }

    public function getSpredsheetChecksum(array $data): int
    {
        $spredsheetChecksum = 0;

        foreach ($data as $row) {
            $rowChecksum = $this->getRowChecksum($row);

            $spredsheetChecksum += $rowChecksum;
        }

        return $spredsheetChecksum;
    }
}
