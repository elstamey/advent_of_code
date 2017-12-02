<?php
/**
 * Class DayOneCommandTest
 *
 * @author  Emily Stamey
 */

use Acme\Console\Command\DayOneCommand;

class DayOneCommandTest extends PHPUnit_Framework_TestCase
{

    public function testAddRepeatDigits()
    {
        $command = new DayOneCommand();

        $this->assertEquals(4, $command->addRepeatDigits('1111'), 'Expected these numbers to add up to 4');
        $this->assertEquals(3, $command->addRepeatDigits('1122'), 'Expected these numbers to add up to 3');
        $this->assertEquals(0, $command->addRepeatDigits('1234'), 'Expected these numbers to add up to 0');
        $this->assertEquals(9, $command->addRepeatDigits('91212129'), 'Expected these numbers to add up to 9');

    }
}
