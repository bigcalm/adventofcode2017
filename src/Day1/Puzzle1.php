<?php

namespace Day1;

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

        $result = $this->calculateCaptcha($data);

        return $result;
    }

    public function parseString(string $input): array
    {
        $input = trim($input);
        $data = str_split($input, 1);

        return $data;
    }

    public function calculateCaptcha(array $data): int
    {
        $dataLength = count($data);

        $captcha = 0;

        for ($i = 0; $i < $dataLength; $i++) {
            $nextInSequence = $this->getNextInSequence($data, $i);

            if ($data[$i] == $nextInSequence) {
                $captcha += $data[$i];
            }
        }

        return $captcha;
    }

    public function getNextInSequence(array $data, int $index): int
    {
        // At the end of the array? Loop back to the beginning
        if ($index < count($data) - 1) {
            $nextInSequence = $data[$index + 1];
        } else {
            $nextInSequence = $data[0];
        }

        return $nextInSequence;
    }
}
