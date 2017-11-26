<?php

namespace spec\Day1;

use Day1\Puzzle1;
use PhpSpec\ObjectBehavior;

class Puzzle1Spec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle1::class);
    }
}
