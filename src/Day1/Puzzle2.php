<?php

namespace Day1;

use PuzzleInterface;

class Puzzle2 extends Puzzle1 implements PuzzleInterface
{
    public function __construct(array $options = [])
    {
        parent::__construct($options);
    }

    public function processInput(string $input)
    {
        parent::processInput($input);
    }
}
