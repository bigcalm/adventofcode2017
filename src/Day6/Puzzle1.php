<?php

namespace Day6;

use PuzzleInterface;

class Puzzle1 implements PuzzleInterface
{
    protected $memoryBanks = [];

    protected $memoryBankStates = [];

    public function __construct(array $options = [])
    {
        // no options to manage
    }

    public function processInput(string $input): int
    {
        $this->parseString($input);

        $result = $this->redistributeMemoryBanksUntilMemoryBankStateIsRepeated();

        return $result;
    }

    public function parseString(string $input)
    {
        $memoryBanks = preg_split("/\s+/", trim($input));

        $memoryBanks = array_map(function ($value) { return (int)$value; }, $memoryBanks);

        $this->setMemoryBanks($memoryBanks);
        $this->recordMemoryBankState();
    }


    public function getMemoryBanks(): array
    {
        return $this->memoryBanks;
    }

    public function setMemoryBanks(array $memoryBanks): void
    {
        $this->memoryBanks = $memoryBanks;
    }


    public function getMemoryBankValue(int $memoryBankId): int
    {
        return $this->getMemoryBanks()[$memoryBankId];
    }

    public function setMemoryBankValue(int $memoryBankId, int $value): void
    {
        $this->memoryBanks[$memoryBankId] = $value;
    }

    public function incrementMemoryBankValue(int $memoryBankId): void
    {
        $this->setMemoryBankValue($memoryBankId, $this->getMemoryBankValue($memoryBankId) + 1);
    }


    public function getIdOfMemoryBankWithGreatestValue(): int
    {
        $memoryBanks = $this->getMemoryBanks();

        $maxValue = max($memoryBanks);

        return array_search($maxValue, $memoryBanks);
    }

    public function distributeMemoryBank(int $memoryBankId): void
    {
        $memoryBankCount = count($this->getMemoryBanks());

        $value = $this->getMemoryBankValue($memoryBankId);

        $this->setMemoryBankValue($memoryBankId, 0);

        $nextMemoryBankId = $memoryBankId + 1;

        while ($value > 0) {
            if ($nextMemoryBankId >= $memoryBankCount) {
                $nextMemoryBankId = 0;
            }

            $this->incrementMemoryBankValue($nextMemoryBankId);
            $value--;

            $nextMemoryBankId++;
        }

        $this->recordMemoryBankState();
    }

    public function debugMemoryBanks()
    {
        echo "\n";
        foreach ($this->getMemoryBanks() as $memoryBank) {
            echo "{$memoryBank}\t";
        }
        echo "\n";
    }


    public function getMemoryBankStates(): array
    {
        return $this->memoryBankStates;
    }



    public function recordMemoryBankState(): void
    {
        $this->memoryBankStates[] = md5(serialize($this->getMemoryBanks()));
    }

    public function getMemoryBankState(int $iterationNumber): string
    {
        return $this->memoryBankStates[$iterationNumber];
    }


    public function redistributeMemoryBanksUntilMemoryBankStateIsRepeated(): int
    {
        $loopCounter = 0;

        $previousMemoryBankStateFound = false;

        while (!$previousMemoryBankStateFound) {
//            $this->debugMemoryBanks();

            $memoryBankId = $this->getIdOfMemoryBankWithGreatestValue();

            $this->distributeMemoryBank($memoryBankId);

            $currentMemoryBankState = md5(serialize($this->getMemoryBanks()));

            $memoryBankStates = $this->getMemoryBankStates();

            // remove the last state as it will be the current state, and thus cause a false positive
            array_pop($memoryBankStates);

            foreach ($memoryBankStates as $memoryBankState) {
                if ($memoryBankState == $currentMemoryBankState) {
                    $previousMemoryBankStateFound = true;
                }
            }

            $loopCounter++;
        }

        return $loopCounter;
    }

}
