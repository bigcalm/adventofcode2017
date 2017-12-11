<?php

namespace spec\Day7;

use Day7\Puzzle1;
use PhpSpec\ObjectBehavior;

class Puzzle1Spec extends ObjectBehavior
{
    public $input = "pbga (66)
xhth (57)
ebii (61)
havc (66)
ktlj (57)
fwft (72) -> ktlj, cntj, xhth
qoyq (66)
padx (45) -> pbga, havc, qoyq
tknk (41) -> ugml, padx, fwft
jptl (61)
ugml (68) -> gyxo, ebii, jptl
gyxo (61)
cntj (57)";

    public function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle1::class);
    }

    public function it_converts_a_line_with_no_children_into_component_parts()
    {
        $programArray = $this->convertInputStringToComponentParts('xhth (57)');

        $programArray->shouldBeArray();
        $programArray->shouldHaveKeyWithValue('id', 'xhth');
        $programArray->shouldHaveKeyWithValue('weight', 57);
        $programArray->shouldHaveKeyWithValue('children', null);
    }

    public function it_converts_a_line_with_children_into_component_parts()
    {
        $programArray = $this->convertInputStringToComponentParts('fwft (72) -> ktlj, cntj, xhth');

        $programArray->shouldBeArray();
        $programArray->shouldHaveKeyWithValue('id', 'fwft');
        $programArray->shouldHaveKeyWithValue('weight', 72);
        $programArray->shouldHaveKeyWithValue('children', ['ktlj', 'cntj', 'xhth']);
    }

    public function it_parses_input_into_data_array()
    {
        $data = $this->parseString($this->input);

        $data->shouldBeArray();
        $data->shouldHaveCount(13);

        $programArray = $data[5];
        $programArray->shouldBeArray();
        $programArray->shouldHaveKeyWithValue('id', 'fwft');
        $programArray->shouldHaveKeyWithValue('weight', 72);
        $programArray->shouldHaveKeyWithValue('children', ['ktlj', 'cntj', 'xhth']);
    }
}
