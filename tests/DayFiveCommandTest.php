<?php

use Acme\Console\Command\DayFiveCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayFiveCommandTest extends \PHPUnit_Framework_TestCase
{

    public static $password = '';

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
        $this->assertContains('result = 18f47a30', $output);
    }
//
//    /** @test */
//    public function testExecutePartTwo()
//    {
//        $application = new Application();
//        $application->add(new DayFiveCommand());
//
//        $command = $application->find('day5');
//        $commandTester = new CommandTester($command);
//        $commandTester->execute(array(
//            'command'  => $command->getName(),
//
//            // prefix the key with a double slash when passing options,
//            // e.g: '--some-option' => 'option_value',
//            '--part2' => true,
//
//        ));
//
//
//        // the output of the command in the console
//        $output = $commandTester->getDisplay();
//        $this->assertContains('result = 6', $output);
//    }



    public function testHashIt()
    {
        $doorId = 'abc';
        $currentIndex = 3231929;
        $password = '';

        while (strlen($password) < 3) {
            DayFiveCommand::hashIt($doorId, $currentIndex);

            $currentIndex++;
        }

        $this->assertEquals('18f47a30', $password, 'expected function to return a number that was not returned');
    }
}
