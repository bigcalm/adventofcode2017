<?php

namespace Day5;

use PuzzleInterface;

class Puzzle1 implements PuzzleInterface
{
    protected $instructions = [];

    protected $currentInstructionLocation = 0;

    protected $nextInstructionLocation = 0;

    protected $stepCounter = 0;

    public function __construct(array $options = [])
    {
        // no options to manage
    }

    public function processInput(string $input): int
    {
        $this->parseString($input);

        $this->walkThroughInstructions();

        $result = $this->stepCounter;

        return $result;
    }

    public function parseString(string $input)
    {
        $instructions = [];

        $rows = explode("\n", $input);

        for ($i = 0; $i < count($rows); $i++) {
            $row = trim($rows[$i]);
            if (!is_numeric($row)) {
                continue;
            }

            $instructions[$i] = $row;
        }

        $this->setInstructions($instructions);
    }


    public function getInstructions(): array
    {
        return $this->instructions;
    }

    public function setInstructions(array $instructions): self
    {
        $this->instructions = $instructions;

        return $this;
    }


    public function getCurrentInstructionLocation(): int
    {
        return $this->currentInstructionLocation;
    }

    public function setCurrentInstructionLocation(int $location): self
    {
        $this->currentInstructionLocation = $location;

        return $this;
    }


    public function getNextInstructionLocation(): int
    {
        return $this->nextInstructionLocation;
    }

    public function setNextInstructionLocation(int $location): self
    {
        $this->nextInstructionLocation = $location;

        return $this;
    }


    public function getCurrentInstructionValue(): int
    {
        return $this->instructions[$this->getCurrentInstructionLocation()];
    }

    public function incrementCurrentInstructionValue(): self
    {
        $this->instructions[$this->getCurrentInstructionLocation()] += 1;

        return $this;
    }


    public function getStepCounter(): int
    {
        return $this->stepCounter;
    }

    public function incrementStepCounter(): self
    {
        $this->stepCounter += 1;

        return $this;
    }


    public function walkThroughInstructions()
    {
        while (true) {
            if (!isset($this->instructions[$this->getNextInstructionLocation()])) {

                // escaped!
                break;
            }

            $this->setCurrentInstructionLocation($this->getNextInstructionLocation());

            $this->setNextInstructionLocation(
                $this->getCurrentInstructionLocation() + $this->getCurrentInstructionValue()
            );

            $this->incrementCurrentInstructionValue();

            $this->incrementStepCounter();
        }
    }

    public function debugInstructions()
    {
        echo "\n" . $this->getStepCounter() . ": ";

        for ($i = 0; $i < count($this->getInstructions()); $i++) {
            if ($i == $this->getCurrentInstructionLocation()) {
                echo "(" . $this->getInstructions()[$i] . ")";
            } elseif ($i == $this->getNextInstructionLocation()) {
                echo "[" . $this->getInstructions()[$i] . "]";
            }  else {
                echo " " . $this->getInstructions()[$i] . " ";
            }

            echo " \t";
        }
    }
}
