<?php

use Acme\Console\Command\DayFiveCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayFiveCommandTest extends PHPUnit\Framework\TestCase
{


    /** @test */
    public function testExecute() : void
    {
        $application = new Application();
        $application->add(new DayFiveCommand());

        $command = $application->find('day5');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday5.txt',

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('result = 820', $output);
    }

    /** @test */
    public function testExecutePartTwo() : void
    {
//        $application = new Application();
//        $application->add(new DayFiveCommand());
//
//        $command = $application->find('day5');
//        $commandTester = new CommandTester($command);
//        $commandTester->execute(array(
//            'command'  => $command->getName(),
//
//            // pass arguments to the helper
//            'inputFile' => 'testday5.txt',
//
//            // prefix the key with a double slash when passing options,
//            // e.g: '--some-option' => 'option_value',
//            '--part2' => true,
//
//
//        ));
//
//
//        // the output of the command in the console
//        $output = $commandTester->getDisplay();
//        $this->assertContains('result = 10', $output);
    }

    public function testGetSeat() : void
    {
        $command = new DayFiveCommand();

        $this->assertEquals([44, 5], $command->getSeat('FBFBBFFRLR'));
        $this->assertEquals([70, 7], $command->getSeat('BFFFBBFRRR'));
        $this->assertEquals([14, 7], $command->getSeat('FFFBBBFRRR'));
        $this->assertEquals([102, 4], $command->getSeat('BBFFBBFRLL'));
    }

    public function testGetLowerHalf() : void
    {
        $command = new DayFiveCommand();

        $this->assertEquals([0, 63], $command->getLowerHalf([0, 127]));
        $this->assertEquals([32, 47], $command->getLowerHalf([32, 63]));
        $this->assertEquals([44, 45], $command->getLowerHalf([44, 47]));
        $this->assertEquals([44, 44], $command->getLowerHalf([44, 45]));

        $this->assertEquals([4, 5], $command->getLowerHalf([4, 7]));

    }

    public function testGetUpperHalf() : void
    {
        $command = new DayFiveCommand();

        $this->assertEquals([32, 63], $command->getUpperHalf([0, 63]));
        $this->assertEquals([40, 47], $command->getUpperHalf([32, 47]));
        $this->assertEquals([44, 47], $command->getUpperHalf([40, 47]));

        $this->assertEquals([4, 7], $command->getUpperHalf([0, 7]));
        $this->assertEquals([5, 5], $command->getUpperHalf([4, 5]));
    }

    public function testGetSeatId() : void
    {
        $command = new DayFiveCommand();

        $this->assertEquals(357, $command->getSeatId(44, 5));
        $this->assertEquals(567, $command->getSeatId(70, 7));
        $this->assertEquals(119, $command->getSeatId(14, 7));
        $this->assertEquals(820, $command->getSeatId(102, 4));
    }

    public function testGetHighestSeatId() : void
    {
        $command = new DayFiveCommand();

        $this->assertEquals(820, $command->getHighestSeatId([357, 567, 119, 820]));
    }
}
