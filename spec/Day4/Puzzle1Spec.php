<?php

namespace spec\Day4;

use Day4\Puzzle1;
use PhpSpec\ObjectBehavior;

class Puzzle1Spec extends ObjectBehavior {
    public function it_is_initializable() {
        $this->shouldHaveType( Puzzle1::class );
    }

    public function it_correctly_parses_input_data()
    {
        $input = "aa bb cc dd ee
        aa bb cc dd aa
        aa bb cc dd aaa
        ";

        $data = $this->parseString($input);
        $data->shouldBeArray();
        $data->shouldHaveCount(3);

        $row = $data[0];
        $row->shouldBeArray();
        $row->shouldHaveCount(5);
    }

    public function it_states_that_input_1_is_valid()
    {
        $input = "aa bb cc dd ee";

        $data = $this->parseString($input);
        $valid = $this->isValidParsePhrase($data[0]);

        $valid->shouldBeBoolean();
        $valid->shouldBe(true);
    }

    public function it_states_that_input_2_is_invalid()
    {
        $input = "aa bb cc dd aa";

        $data = $this->parseString($input);
        $valid = $this->isValidParsePhrase($data[0]);

        $valid->shouldBeBoolean();
        $valid->shouldBe(false);
    }

    public function it_states_that_input_3_is_valid()
    {
        $input = "aa bb cc dd aaa";

        $data = $this->parseString($input);
        $valid = $this->isValidParsePhrase($data[0]);

        $valid->shouldBeBoolean();
        $valid->shouldBe(true);
    }

    public function it_finds_number_of_valid_strings_in_input()
    {
        $input = "aa bb cc dd ee
        aa bb cc dd aa
        aa bb cc dd aaa
        ";

        $data = $this->parseString($input);

        $validCount = $this->countValidPassPhrases($data);

        $validCount->shouldBeInteger();
        $validCount->shouldBe(2);
    }
}
