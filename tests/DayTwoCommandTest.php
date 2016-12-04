<?php

use Acme\Console\Command\DayTwoCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayTwoCommandTest extends \PHPUnit_Framework_TestCase
{

    /** @test */
    public function testExecute()
    {
        $application = new Application();
        $application->add(new DayTwoCommand());

        $command = $application->find('day2');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday2.txt',

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('result = 1985', $output);
    }

    /** @test */
    public function testExecutePart2()
    {
        $application = new Application();
        $application->add(new DayTwoCommand());

        $command = $application->find('day2');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday2.txt',

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
            '--part2' => true,

        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('result = 5DB3', $output);
    }

}
