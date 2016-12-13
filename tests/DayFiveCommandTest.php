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
        $application->add(new DayFiveCommand());

        $command = $application->find('day5');
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



    public function testHashIt()
    {
        $doorId = 'abc';
        $currentIndex = 3231929;
        $password = '';

        $command = new DayFiveCommand();

        while (strlen($password) < 8) {
            $password .= $command->hashIt($doorId, $currentIndex);

            $currentIndex++;
        }

        $this->assertEquals('18f47a30', $password, 'expected function to return a number that was not returned');
    }
}
