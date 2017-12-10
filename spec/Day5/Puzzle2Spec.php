<?php

namespace spec\Day5;

use Day5\Puzzle2;
use PhpSpec\ObjectBehavior;

class Puzzle2Spec extends ObjectBehavior
{
    public $input = "0
                3
                0
                1
                -3";

    public function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle2::class);
    }

    public function it_walks_through_the_input()
    {
        $result = $this->processInput($this->input);

        $result->shouldBeInteger();
        $result->shouldBe(10);
    }
}
