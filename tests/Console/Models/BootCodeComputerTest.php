<?php

namespace Console\Models;

use Acme\Console\Models\BootCodeComputer;
use PHPUnit\Framework\TestCase;

class BootCodeComputerTest extends TestCase
{
    public function testGetAccumulator() : void
    {
        $computer = new BootCodeComputer();
        $this->assertEquals(0, $computer->getAccumulator());

        $computer->accumulate(5);
        $this->assertEquals(5, $computer->getAccumulator());

        $computer->accumulate(-3);
        $this->assertEquals(2, $computer->getAccumulator());
    }

    public function testGetPosition() : void
    {
        $computer = new BootCodeComputer();
        $this->assertEquals(0, $computer->getPosition());

        $computer->makeJump(5);
        $this->assertEquals(5, $computer->getPosition());

        $computer->makeJump(-3);
        $this->assertEquals(2, $computer->getPosition());
    }

}
