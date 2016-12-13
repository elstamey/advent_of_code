<?php
use Acme\Console\Command\DayThirteenCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayThirteenCommandTest extends PHPUnit_Framework_TestCase
{


    public function testCalculationMethod()
    {
        $x = 1;
        $y = 1;
        $command = new DayThirteenCommand();


        $this->assertEquals(5, $command->calculate($x, $y), 'Did not receive expected calculated value');
    }

    public function testConvertToBinaryMethod()
    {
        $command = new DayThirteenCommand();

        $this->assertEquals('101', $command->convertToBinary(5), 'Did not receive the expected binary string');

    }

    public function testCountOnesInBinaryStringMethod()
    {
        $command = new DayThirteenCommand();

        $this->assertEquals(2, $command->countOnesInBinaryString('101'), 'Did not receive the expected number of ones in string');
    }


}
