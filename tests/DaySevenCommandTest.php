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
        $this->assertContains('result = ', $output);
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
        $this->assertContains('result = ', $output);
    }

    public function testIsAbba()
    {
        $testAbbaStrings = ['abba', 'poop','ioxxoj'];
        $testNotAbbaStrings = ['dogs', 'test', 'aaaa'];

        foreach ($testAbbaStrings as $test) {
            $this->assertTrue(DaySevenCommand::isAbba($test), 'expected string to pass '.$test);
        }

        foreach ($testNotAbbaStrings as $test) {
            $this->assertFalse(DaySevenCommand::isAbba($test), 'expected string to fail '.$test);
        }
    }

    public function testSupportsTls()
    {
        $passingLines = ['abba[mnop]qrst','ioxxoj[asdfgh]zxcvbn'];
        $failingLines = ['abcd[bddb]xyyx', 'aaaa[qwer]tyui'];

        foreach ($passingLines as $passLine) {
            $this->assertTrue(DaySevenCommand::supportsTLS($passLine), 'expecting string to pass '.$passLine);
        }

        foreach ($failingLines as $failLine) {
            $this->assertFalse(DaySevenCommand::supportsTLS($failLine), 'expecting string to fail '.$failLine);
        }
    }

}
