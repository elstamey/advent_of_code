<?php
use Acme\Console\Command\DayThirteenCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayThirteenCommandTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    public function testExecute()
    {
        $application = new Application();
        $application->add(new DayThirteenCommand());

        $command = $application->find('day13');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('result = d4cd2ee1', $output);
    }


    public function testCalculationMethod()
    {
        $x = 1;
        $y = 1;
        $command = new DayThirteenCommand();
        $favNumber = 1364;

        $this->assertEquals(1372, $command->calculate($x, $y, $favNumber), 'Did not receive expected calculated value');
    }

    public function testConvertToBinaryMethod()
    {
        $command = new DayThirteenCommand();

        $this->assertEquals('10101011100', $command->convertToBinary(1372), 'Did not receive the expected binary string');

    }

    public function testCountOnesInBinaryStringMethod()
    {
        $command = new DayThirteenCommand();

        $this->assertEquals(6, $command->countOnesInBinaryString('10101011100'), 'Did not receive the expected number of ones in string');
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

//        print "\n\nDUMP\n";
//        var_dump($paths);
    }

    public function testGetRoomMarkerForMethod()
    {
        $command = new DayThirteenCommand();
        $command->inputString = 10;
        $command->initialSpace = [0,0];

        $key1 = 0;
        $key2 = 2;

        $this->assertEquals('.', $command->getRoomMarkerFor($key2,$key1));
    }

}
