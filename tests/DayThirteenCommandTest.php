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


        $this->assertEquals(1369, $command->calculate($x, $y), 'Did not receive expected calculated value');
    }

    public function testConvertToBinaryMethod()
    {
        $command = new DayThirteenCommand();

        $this->assertEquals('10101011001', $command->convertToBinary(1369), 'Did not receive the expected binary string');

    }

    public function testCountOnesInBinaryStringMethod()
    {
        $command = new DayThirteenCommand();

        $this->assertEquals(6, $command->countOnesInBinaryString('10101011001'), 'Did not receive the expected number of ones in string');
    }

    public function testGetRoomMarkerMethod()
    {
        $command = new DayThirteenCommand();

        $this->assertEquals('#', $command->getRoomMarker(4), 'Did not get wall "." room marker');
        $this->assertEquals('.', $command->getRoomMarker(7), 'Did not get open space "#" room marker');
    }


}
