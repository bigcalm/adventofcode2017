<?php

namespace Day4;

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

        $result = $this->countValidPassPhrases($data);

        return $result;
    }

    public function parseString(string $input): array
    {
        $data = [];

        $rows = explode("\n", $input);

        for ($i = 0; $i < count($rows); $i++) {
            $row = trim($rows[$i]);
            if (empty($row)) {
                continue;
            }

            $data[$i] = preg_split("/\s+/", $row);
        }

        return $data;
    }

    public function isValidParsePhrase(array $passPhrase): bool
    {
        $wordFrequency = array_count_values($passPhrase);

        $valid = max($wordFrequency) == 1;

        return $valid;
    }

    public function countValidPassPhrases(array $data): int
    {
        $validCounter = 0;

        foreach ($data as $passPhrase) {
            if ($this->isValidParsePhrase($passPhrase)) {
                $validCounter++;
            }
        }

        return $validCounter;
    }

}
