<?php

use Acme\Console\Command\DayThreeCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayThreeCommandTest extends \PHPUnit_Framework_TestCase
{

    /** @test */
    public function testExecute()
    {
        $application = new Application();
        $application->add(new DayThreeCommand());

        $command = $application->find('day3');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'square' => 1,

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('result = 0', $output);
    }

    /** @test */
    public function testExecutePartTwo()
    {
        $application = new Application();
        $application->add(new DayThreeCommand());

        $command = $application->find('day3');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'square' => 1,

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
            '--part2' => true,

        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('result = 0', $output);
    }

    /** @test */
    public function testManhattanDistance()
    {
        $command = new DayThreeCommand();

        $this->assertEquals(6, $command->manhattanDistance([0,0], [3,3]), 'Did not get manhattan distance of 6');
    }


    /** @test */
    public function testGetPositionOfSquare()
    {
        $command = new DayThreeCommand();

        $this->assertEquals([0,0], $command->getPositionOfSquare(1), 'Did not get position of (0,0)');
        $this->assertEquals([2,1], $command->getPositionOfSquare(12), 'Did not get position of (2,1)');
        $this->assertEquals([2,0], $command->getPositionOfSquare(23), 'Did not get position of (2,0)');
    }


    /** @test */
    public function testBuildGridUpToSquare()
    {
        $command = new DayThreeCommand();

        $myGrid = [
            0 => [17,  16,  15,  14,  13 ],
            1 => [18,   5,   4,   3,  12 ],
            2 => [19,   6,   1,   2,  11 ],
            3 => [20,   7,   8,   9,  10 ],
            4 => [21,  22,  23 ],
        ];

        $this->assertEquals($myGrid, $command->buildGridUpToSquare(23), 'Did not build a grid that matched');
    }
}
