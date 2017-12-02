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

    public function it_converts_input_sting_into_an_array()
    {
        $data = $this->parseString('1122');

        $data->shouldBeArray();
        $data->shouldHaveCount(4);
    }

    public function it_gets_next_in_sequence()
    {
        $data = $this->parseString('1122');
        $this->getNextInSequence($data, 0)->shouldBe(1);
        $this->getNextInSequence($data, 1)->shouldBe(2);
        $this->getNextInSequence($data, 2)->shouldBe(2);
        $this->getNextInSequence($data, 3)->shouldBe(1);

        $data = $this->parseString('12345');
        $this->getNextInSequence($data, 0)->shouldBe(2);
        $this->getNextInSequence($data, 1)->shouldBe(3);
        $this->getNextInSequence($data, 2)->shouldBe(4);
        $this->getNextInSequence($data, 3)->shouldBe(5);
        $this->getNextInSequence($data, 4)->shouldBe(1);
    }

    public function it_calculates_captcha_to_be_3_for_input_1122()
    {
        $data = $this->parseString('1122');

        $captcha = $this->calculateCaptcha($data);
        $captcha->shouldBeInteger();
        $captcha->shouldBe(3);
    }

    public function it_calculates_captcha_to_be_4_for_input_1111()
    {
        $result = $this->processInput('1111');

        $result->shouldBe(4);
    }

    public function it_calculates_captcha_to_be_0_for_input_12345()
    {
        $result = $this->processInput('12345');

        $result->shouldBe(0);
    }

    public function it_calculates_captcha_to_be_9_for_input_91212129()
    {
        $result = $this->processInput('91212129');

        $result->shouldBe(9);
    }
}
