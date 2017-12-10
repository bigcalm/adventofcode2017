<?php

namespace Day5;

class Puzzle2 extends Puzzle1
{
    public function incrementCurrentInstructionValue()
    {
        if ($this->getCurrentInstructionValue() >= 3) {
            $incrementValue = -1;
        } else {
            $incrementValue = 1;
        }

        $this->instructions[$this->getCurrentInstructionLocation()] += $incrementValue;

        return $this;
    }
}
