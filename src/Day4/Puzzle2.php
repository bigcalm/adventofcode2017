<?php

namespace Day4;

use PuzzleInterface;

class Puzzle2 extends Puzzle1
{
    public function isValidParsePhrase(array $passPhrase): bool
    {
        $anagramFrequency = [];

        foreach($passPhrase as $word) {
            $splitWord = str_split($word, 1);

            $charFrequency = array_count_values($splitWord);
            ksort($charFrequency);

            $anagramFrequency[] = md5(serialize($charFrequency));
        }

        $anagramFrequencies = array_count_values($anagramFrequency);

        $valid = max($anagramFrequencies) == 1;

        return $valid;
    }
}
