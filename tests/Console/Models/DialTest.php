<?php

namespace Console\Models;

use Acme\Console\Models\Dial;
use PHPUnit\Framework\TestCase;

class DialTest extends TestCase
{
    public function testHasFace(): void
    {
        $dial = new Dial(0,9);
        $this->assertEquals(0, $dial->getPointer());

        $this->assertEquals(0, $dial->getFacePointer());

        $this->assertEquals([0,1,2,3,4,5,6,7,8,9], $dial->getFace());
    }

    public function testCanMove()
    {
        $dial = new Dial(0,99);
        $dial->movePointer("R11");

        $this->assertEquals(11, $dial->getPointer());

        $dial->movePointer("R8");
        $this->assertEquals(19, $dial->getPointer());

        $dial->movePointer("L19");
        $this->assertEquals(0, $dial->getPointer());

        $dial->movePointer("L1");
        $this->assertEquals(99, $dial->getPointer());

        $dial->movePointer("R1");
        $this->assertEquals(0, $dial->getPointer());
    }
}
