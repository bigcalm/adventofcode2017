<?php

namespace spec\Day2;

use Day2\Puzzle2;
use PhpSpec\ObjectBehavior;

class Puzzle2Spec extends ObjectBehavior
{
    public $input = "5\t9\t2\t8
9\t4\t7\t3
3\t8\t6\t5
";

    public function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle2::class);
    }

    public function it_confirms_if_two_numbers_are_divisible_with_no_remainder()
    {
        $isDivisible = $this->isDivisibleWithNoRemainder(2, 3);
        $isDivisible->shouldBeBoolean();
        $isDivisible->shouldBe(false);

        $isDivisible = $this->isDivisibleWithNoRemainder(3, 2);
        $isDivisible->shouldBeBoolean();
        $isDivisible->shouldBe(false);

        $isDivisible = $this->isDivisibleWithNoRemainder(2, 6);
        $isDivisible->shouldBeBoolean();
        $isDivisible->shouldBe(false);

        $isDivisible = $this->isDivisibleWithNoRemainder(6, 2);
        $isDivisible->shouldBeBoolean();
        $isDivisible->shouldBe(true);
    }

    public function it_calculates_division_of_two_numbers()
    {
        $divisionResult = $this->divide(6, 2);

        $divisionResult->shouldBeInteger();
        $divisionResult->shouldBe(3);
    }

    public function it_finds_the_divisible_pair_in_row()
    {
        $data = $this->parseString($this->input);

        $divisiblePair = $this->getDivisiblePair($data[0]);

        $divisiblePair->shouldBeArray();
        $divisiblePair[0]->shouldBe(8);
        $divisiblePair[1]->shouldBe(2);

        $divisiblePair = $this->getDivisiblePair($data[1]);
        $divisiblePair[0]->shouldBe(9);
        $divisiblePair[1]->shouldBe(3);

        $divisiblePair = $this->getDivisiblePair($data[2]);
        $divisiblePair[0]->shouldBe(6);
        $divisiblePair[1]->shouldBe(3);
    }

    public function it_finds_the_result_of_dividing_the_divisible_pair_for_a_row()
    {
        $data = $this->parseString($this->input);

        $divisionResult = $this->getDivisionOfDivisiblePairIn($data[0]);

        $divisionResult->shouldBeInteger();
        $divisionResult->shouldBe(4);
    }

    public function it_sums_the_division_results_for_each_row_in_spreadsheet()
    {
        $data = $this->parseString($this->input);

        $sumOfDivisionResults = $this->getSumOfAllDivisionResults($data);

        $sumOfDivisionResults->shouldBeInteger();
        $sumOfDivisionResults->shouldBe(9);
    }
}
