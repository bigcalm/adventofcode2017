<?php

namespace spec\Day3;

use Day3\Puzzle1;
use PhpSpec\ObjectBehavior;

class Puzzle1Spec extends ObjectBehavior {
    public function it_is_initializable() {
        $this->shouldHaveType( Puzzle1::class );
    }

    public function it_generates_memory_map_with_25_locations()
    {
        $this->generateMemoryMap(25);

//        $this->displayMemoryMap();exit;

        $this->memoryMap->shouldBeArray();
        $this->memoryMap->shouldHaveCount(5);

        $this->memoryMap[0][0]->shouldBe(1); // centre
        $this->memoryMap[-2][-2]->shouldBe(17); // top left
        $this->memoryMap[2][-2]->shouldBe(13); // top right
        $this->memoryMap[-2][2]->shouldBe(21); // bottom left
        $this->memoryMap[2][2]->shouldBe(25); // bottom right
    }

    public function it_calculates_distance_to_position_1()
    {
        $targetMemoryLocation = 1;

        $this->generateMemoryMap($targetMemoryLocation);

        $result = $this->calculateDistanceToLocation($targetMemoryLocation);

        $result->shouldBe(0);
    }

    public function it_calculates_distance_to_position_12()
    {
        $targetMemoryLocation = 12;

        $this->generateMemoryMap($targetMemoryLocation);

        $result = $this->calculateDistanceToLocation($targetMemoryLocation);

        $result->shouldBe(3);
    }

    public function it_calculates_distance_to_position_23()
    {
        $targetMemoryLocation = 23;

        $this->generateMemoryMap($targetMemoryLocation);

        $result = $this->calculateDistanceToLocation($targetMemoryLocation, true);

        $result->shouldBe(2);
    }

    public function it_calculates_distance_to_position_1024()
    {
        $targetMemoryLocation = 1024;

        $this->generateMemoryMap($targetMemoryLocation);

        $result = $this->calculateDistanceToLocation($targetMemoryLocation);

        $result->shouldBe(31);
    }
}
