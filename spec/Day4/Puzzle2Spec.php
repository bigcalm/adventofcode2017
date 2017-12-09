<?php

namespace spec\Day4;

use Day4\Puzzle2;
use PhpSpec\ObjectBehavior;

class Puzzle2Spec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle2::class);
    }

    public function it_states_that_input_1_is_valid()
    {
        $input = "abcde fghij";

        $data = $this->parseString($input);
        $valid = $this->isValidParsePhrase($data[0]);

        $valid->shouldBeBoolean();
        $valid->shouldBe(true);
    }

    public function it_states_that_input_2_is_valid()
    {
        $input = "abcde xyz ecdab";

        $data = $this->parseString($input);
        $valid = $this->isValidParsePhrase($data[0]);

        $valid->shouldBeBoolean();
        $valid->shouldBe(false);
    }

    public function it_states_that_input_3_is_valid()
    {
        $input = "a ab abc abd abf abj";

        $data = $this->parseString($input);
        $valid = $this->isValidParsePhrase($data[0]);

        $valid->shouldBeBoolean();
        $valid->shouldBe(true);
    }

    public function it_states_that_input_4_is_valid()
    {
        $input = "iiii oiii ooii oooi oooo";

        $data = $this->parseString($input);
        $valid = $this->isValidParsePhrase($data[0]);

        $valid->shouldBeBoolean();
        $valid->shouldBe(true);
    }

    public function it_states_that_input_5_is_valid()
    {
        $input = "oiii ioii iioi iiio";

        $data = $this->parseString($input);
        $valid = $this->isValidParsePhrase($data[0]);

        $valid->shouldBeBoolean();
        $valid->shouldBe(false);
    }
}
