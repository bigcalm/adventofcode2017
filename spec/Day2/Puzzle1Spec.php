<?php

namespace spec\Day2;

use Day2\Puzzle1;
use PhpSpec\ObjectBehavior;

class Puzzle1Spec extends ObjectBehavior
{
    public $input = "5 1 9 5
7 5 3
2 4 6 8";

    public function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle1::class);
    }

    public function it_converts_input_into_array()
    {
        $data = $this->parseString($this->input);

        $data->shouldBeArray();
        $data->shouldHaveCount(3);

        $data[0]->shouldBeArray();
        $data[0]->shouldHaveCount(4);

        $data[1]->shouldBeArray();
        $data[1]->shouldHaveCount(3);

        $data[2]->shouldBeArray();
        $data[2]->shouldHaveCount(4);
    }

    public function it_finds_max_and_min_values_of_array()
    {
        $data = $this->parseString($this->input);

        $extremeValues = $this->getExtremeValues($data[0]);

        $extremeValues->shouldBeArray();
        $extremeValues->shouldHaveCount(2);

        $extremeValues['min']->shouldBe(1);
        $extremeValues['max']->shouldBe(9);
    }

    public function it_calculates_checksum_for_row()
    {
        $data = $this->parseString($this->input);

        $rowChecksum = $this->getRowChecksum($data[0]);

        $rowChecksum->shouldBeInteger();
        $rowChecksum->shouldBe(8);
    }

    public function it_calculates_checksum_for_whole_data_set()
    {
        $data = $this->parseString($this->input);

        $spredsheetChecksum = $this->getSpredsheetChecksum($data);

        $spredsheetChecksum->shouldBeInteger();
        $spredsheetChecksum->shouldBe(18);
    }
}
