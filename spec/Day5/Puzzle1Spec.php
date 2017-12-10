<?php

namespace spec\Day5;

use Day5\Puzzle1;
use PhpSpec\ObjectBehavior;

class Puzzle1Spec extends ObjectBehavior
{
    public $input = "0
                3
                0
                1
                -3";

    public function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle1::class);
    }

    public function it_parses_input_and_stores_it_as_property()
    {
        $this->parseString($this->input);

        $data = $this->getInstructions();

        $data->shouldBeArray();
        $data->shouldHaveCount(5);
    }

    public function it_walks_through_the_input()
    {
        $result = $this->processInput($this->input);

        $result->shouldBeInteger();
        $result->shouldBe(5);
    }
}
