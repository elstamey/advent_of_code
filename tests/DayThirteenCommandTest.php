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
        $favNumber = 1364;


        $this->assertEquals(1369, $command->calculate($x, $y, $favNumber), 'Did not receive expected calculated value');
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

        $this->assertEquals('.', $command->getRoomMarker(4), 'Did not get wall "." room marker');
        $this->assertEquals('#', $command->getRoomMarker(7), 'Did not get open space "#" room marker');
    }


    public function testGetPathsBetweenMethod()
    {
        $command = new DayThirteenCommand();
        $command->inputString = 10;
        $command->initialSpace = [0,0];

        $command->initializeFloor(10,7);

        $paths = $command->getPathsBetween([0,0], [7,4]);

        $command->displayFloor();

        print "\n\nDUMP\n";
        var_dump($paths);
    }

    public function testGetRoomMarkerForMethod()
    {
        $command = new DayThirteenCommand();
        $command->inputString = 10;
        $command->initialSpace = [0,0];

        $key1 = 2;
        $key2 = 0;

        $this->assertEquals('.', $command->getRoomMarkerFor($key1,$key2));
    }


}
