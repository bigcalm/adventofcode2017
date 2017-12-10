<?php

namespace Day6;

class Puzzle2 extends Puzzle1
{
    public function redistributeMemoryBanksUntilMemoryBankStateIsRepeated(): int
    {
        $loopCounter = 0;

        $previousMemoryBankStateFound = false;

        $targetMemoryBankState = null;

        while (!$previousMemoryBankStateFound) {
//            $this->debugMemoryBanks();

            $memoryBankId = $this->getIdOfMemoryBankWithGreatestValue();

            $this->distributeMemoryBank($memoryBankId);

            $currentMemoryBankState = md5(serialize($this->getMemoryBanks()));

            $memoryBankStates = $this->getMemoryBankStates();

            // remove the last state as it will be the current state, and thus cause a false positive
            array_pop($memoryBankStates);

            foreach ($memoryBankStates as $memoryBankState) {
                if (is_null($targetMemoryBankState) && $memoryBankState == $currentMemoryBankState) {
                    $targetMemoryBankState = $currentMemoryBankState;
                    $loopCounter = 0;

                    // reset the memory states
                    $this->memoryBankStates = [];
                    break;
                } elseif ($currentMemoryBankState == $targetMemoryBankState) {
                    break 2;
                }
            }

            $loopCounter++;
        }

        return $loopCounter;
    }
}
