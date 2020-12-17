<?php

use Acme\Console\Command\DaySixCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DaySixCommandTest extends PHPUnit\Framework\TestCase
{

    /** @test */
    public function testExecute() :void
    {
        $application = new Application();
        $application->add(new DaySixCommand());

        $command = $application->find('day6');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'   => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday6.txt',

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('result = 11', $output);
    }

    /** @test */
    public function testExecutePartTwo() : void
    {
        $application = new Application();
        $application->add(new DaySixCommand());

        $command = $application->find('day6');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'   => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday6.txt',

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
            '--part2'   => true,
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('result = 6', $output);
    }

    public function testRedistribute() : void
    {
        $command = new DaySixCommand();

    }

    public function testFindKeyOfLargest() : void
    {
        $command = new DaySixCommand();

    }

    public function testCheckForPreviouslySeenConfig() : void
    {
        $command = new DaySixCommand();

    }

    public function testIsSameConfig() : void
    {
        $command = new DaySixCommand();

    }
}