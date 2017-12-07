<?php

use Acme\Console\Command\DayFiveCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayFiveCommandTest extends \PHPUnit_Framework_TestCase
{

    public $password = 'foo';

    /** @test */
    public function testExecute()
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
        $this->assertContains('result = 5', $output);
    }

    /** @test */
    public function testExecutePartTwo()
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
            '--part2' => true,


        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('result = 10', $output);
    }

    public function testTraverseJumpInstructions()
    {
        $command = new DayFiveCommand();

        $this->assertEquals(5,
            $command->traverseJumpInstructions([0, 3, 0, 1, -3]),
            'Expected traversal to complete in 5 steps');


        $this->assertEquals(10,
            $command->traverseJumpInstructions([0, 3, 0, 1, -3], true),
            'Expected traversal to complete in 5 steps');
    }
}
