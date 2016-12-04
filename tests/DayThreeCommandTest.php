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
            'inputFile' => 'testday3.txt',

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
            'inputFile' => 'testday3.txt',

            '--part2' => true,

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('result = 6', $output);
    }
    /** @test */
    function testIsTriangle()
    {
        $this->assertTrue(DayThreeCommand::isTriangle(1, 2, 2), 'Did not get valid triangle, expecting valid');
        $this->assertTrue(DayThreeCommand::isTriangle(7, 10, 5), 'Did not get valid triangle, expecting valid');
        $this->assertFalse(DayThreeCommand::isTriangle(5, 10, 25), 'Got valid triangle, expecting not valid');
        $this->assertFalse(DayThreeCommand::isTriangle(3, 5, 8), 'Got valid triangle, expecting not valid');
    }

}
