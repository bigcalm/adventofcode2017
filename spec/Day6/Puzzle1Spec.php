<?php

namespace spec\Day6;

use Day6\Puzzle1;
use PhpSpec\ObjectBehavior;

class Puzzle1Spec extends ObjectBehavior
{
    public $input = "0 2 7 0";

    public function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle1::class);
    }

    public function it_parses_input_and_stores_it_as_property()
    {
        $this->parseString($this->input);

        $memoryBanks = $this->getMemoryBanks();

        $memoryBanks->shouldBeArray();
        $memoryBanks->shouldHaveCount(4);
    }

    public function it_gets_value_of_a_memory_bank()
    {
        $this->parseString($this->input);

        $expectedMemoryBankValues = [0, 2, 7, 0];

        for ($i = 0; $i <= count($this->getMemoryBanks()); $i++) {
            $memoryBankValue = $this->getMemoryBankValue($i);

            $memoryBankValue->shouldBeInteger();
            $memoryBankValue->shouldBe($expectedMemoryBankValues[$i]);
        }
    }

    public function it_finds_the_memory_bank_with_the_greatest_value()
    {
        $input = "1 3 2 3";

        $this->parseString($input);

        $memoryBankId = $this->getIdOfMemoryBankWithGreatestValue();

        $memoryBankId->shouldBeInteger();
        $memoryBankId->shouldBe(1);
    }

    public function it_distributes_values()
    {
        $this->parseString($this->input);

        $this->distributeMemoryBank(2);

        $expectedMemoryBankValues = [2, 4, 1, 2];

        for ($i = 0; $i <= count($this->getMemoryBanks()); $i++) {
            $memoryBankValue = $this->getMemoryBankValue($i);

            $memoryBankValue->shouldBeInteger();
            $memoryBankValue->shouldBe($expectedMemoryBankValues[$i]);
        }
    }

    public function it_keeps_track_of_memory_bank_states()
    {
        $this->parseString($this->input);

        $this->distributeMemoryBank(2);


        $expectedMemoryBankState = md5(serialize([0, 2, 7, 0]));
        $memoryBlockState = $this->getMemoryBankState(0);

        $memoryBlockState->shouldBeString();
        $memoryBlockState->shouldBe($expectedMemoryBankState);


        $expectedMemoryBankState = md5(serialize([2, 4, 1, 2]));
        $memoryBlockState = $this->getMemoryBankState(1);

        $memoryBlockState->shouldBeString();
        $memoryBlockState->shouldBe($expectedMemoryBankState);
    }

    public function it_counts_the_number_of_loops_to_get_a_repeated_memory_bank_state()
    {
        $this->parseString($this->input);

        $result = $this->redistributeMemoryBanksUntilMemoryBankStateIsRepeated();

        $result->shouldBeInteger();
        $result->shouldBe(5);
    }
}
