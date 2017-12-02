<?php

namespace spec\Day1;

use Day1\Puzzle2;
use PhpSpec\ObjectBehavior;

class Puzzle2Spec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle2::class);
    }

    public function it_gets_next_in_sequence_index_0()
    {
        $data = $this->parseString('123456');
        $this->getNextInSequence($data, 0)->shouldBe(4);
    }

    public function it_gets_next_in_sequence_index_1()
    {
        $data = $this->parseString('123456');
        $this->getNextInSequence($data, 1)->shouldBe(5);
    }

    public function it_gets_next_in_sequence_index_2()
    {
        $data = $this->parseString('123456');
        $this->getNextInSequence($data, 2)->shouldBe(6);
    }

    public function it_gets_next_in_sequence_index_3()
    {
        $data = $this->parseString('123456');
        $this->getNextInSequence($data, 3)->shouldBe(1);
    }

    public function it_gets_next_in_sequence_index_4()
    {
        $data = $this->parseString('123456');
        $this->getNextInSequence($data, 4)->shouldBe(2);
    }

    public function it_gets_next_in_sequence_index_5()
    {
        $data = $this->parseString('123456');
        $this->getNextInSequence($data, 5)->shouldBe(3);
    }

    public function it_calculates_captcha_to_be_6_for_input_1212()
    {
        $result = $this->processInput('1212');

        $result->shouldBe(6);
    }

    public function it_calculates_captcha_to_be_0_for_input_1221()
    {
        $result = $this->processInput('1221');

        $result->shouldBe(0);
    }

    public function it_calculates_captcha_to_be_4_for_input_123425()
    {
        $result = $this->processInput('1221');

        $result->shouldBe(0);
    }

    public function it_calculates_captcha_to_be_4_for_input_12131415()
    {
        $result = $this->processInput('12131415');

        $result->shouldBe(4);
    }
}
