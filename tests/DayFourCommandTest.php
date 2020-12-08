<?php

use Acme\Console\Command\DayFourCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayFourCommandTest extends PHPUnit\Framework\TestCase
{

//    /** @test */
    public function testExecute() : void
    {
        $application = new Application();
        $application->add(new DayFourCommand());

        $command = $application->find('day4');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday4.txt',

        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('result = 2', $output);
    }

//    /** @test */
//    public function testExecutePartTwo()
//    {
//        $application = new Application();
//        $application->add(new DayFourCommand());
//
//        $command = $application->find('day4');
//        $commandTester = new CommandTester($command);
//        $commandTester->execute(array(
//            'command'  => $command->getName(),
//
//            // pass arguments to the helper
//            'inputFile' => 'testday4.txt',
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


}
