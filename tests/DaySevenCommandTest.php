<?php

use Acme\Console\Command\DaySevenCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DaySevenCommandTest extends \PHPUnit_Framework_TestCase
{

    public $password = 'foo';

    /** @test */
    public function testExecute()
    {
        $application = new Application();
        $application->add(new DaySevenCommand());

        $command = $application->find('day7');
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

    /** @test */
    public function testExecutePartTwo()
    {
        $application = new Application();
        $application->add(new DaySevenCommand());

        $command = $application->find('day7');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
            '--part2' => true,


        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('result = f2c730e5', $output);
    }



    public function testIsAbba()
    {
        $testAbbaStrings = ['abba', 'poop'];
        $testNotAbbaStrings = ['dogs', 'test'];

        foreach ($testAbbaStrings as $test) {
            $this->assertTrue(DaySevenCommand::isAbba($test), 'expected string to pass');
        }

        foreach ($testNotAbbaStrings as $test) {
            $this->assertFalse(DaySevenCommand::isAbba($test), 'expected string to fail');
        }
    }
}
