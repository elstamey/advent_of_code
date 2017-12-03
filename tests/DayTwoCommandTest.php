<?php

use Acme\Console\Command\DayTwoCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayTwoCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testGetRowMath()
    {
        $command = new DayTwoCommand();

        $this->assertEquals(3, $command->getRowMath('5 3 2'), 'Expecting to return 3');
        $this->assertEquals(8, $command->getRowMath('5 1 9 5'), 'Expecting to return 8');
        $this->assertEquals(4, $command->getRowMath('7 5 3'), 'Expecting to return 4');
        $this->assertEquals(6, $command->getRowMath('2 4 6 8'), 'Expecting to return 6');
    }

    public function testGetChecksum()
    {
        $command = new DayTwoCommand();

        $this->assertEquals(10, $command->getChecksum([5, 3, 2]), 'Expecting to return 10');
    }

}
