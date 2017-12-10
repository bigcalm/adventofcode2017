<?php

namespace spec\Day6;

use Day6\Puzzle2;
use PhpSpec\ObjectBehavior;

class Puzzle2Spec extends ObjectBehavior
{
    public $input = "0 2 7 0";

    public function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle2::class);
    }

    public function it_counts_loops_until_2nd_instance_of_memory_duplication()
    {
        $this->parseString($this->input);

        $result = $this->redistributeMemoryBanksUntilMemoryBankStateIsRepeatedTwice();

        $result->shouldBeInteger();
        $result->shouldBe(4);

    }
}
