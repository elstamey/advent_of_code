<?php

use Acme\Console\Command\DayTwoCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayTwoCommandTest extends \PHPUnit_Framework_TestCase
{
//    /** @test */
//    public function testExecute()
//    {
//        $application = new Application();
//        $application->add(new DayTwoCommand());
//
//        $command = $application->find('day2');
//        $commandTester = new CommandTester($command);
//        $commandTester->execute(array(
//            'command'  => $command->getName(),
//
//            // pass arguments to the helper
//            'inputFile' => 'testday2.txt',
//
//            // prefix the key with a double slash when passing options,
//            // e.g: '--some-option' => 'option_value',
//        ));
//
//
//        // the output of the command in the console
//        $output = $commandTester->getDisplay();
//        $this->assertContains('result = 12', $output);
//    }
//
//    /** @test */
//    public function testExecutePartTwo()
//    {
//        $application = new Application();
//        $application->add(new DayTwoCommand());
//
//        $command = $application->find('day2');
//        $commandTester = new CommandTester($command);
//        $commandTester->execute(array(
//            'command'  => $command->getName(),
//
//            // pass arguments to the helper
//            'inputFile' => 'testday2b.txt',
//
//            // prefix the key with a double slash when passing options,
//            // e.g: '--some-option' => 'option_value',
//            '--part2' => true,
//
//
//        ));
//
//
//        // the output of the command in the console
//        $output = $commandTester->getDisplay();
//        $this->assertContains('result = fgij', $output);
//    }
//
//    public function testGetComparison()
//    {
//        $command = new DayTwoCommand();
//
//        $this->assertEquals(60, $command->getComparison('abcde', 'fghij'));
//        $this->assertEquals(60, $command->getComparison('abcde', 'klmno'));
//        $this->assertEquals(60, $command->getComparison('abcde', 'pqrst'));
//        $this->assertEquals(60, $command->getComparison('abcde', 'axcye'));
//        $this->assertEquals(80, $command->getComparison('fghij', 'fguij'));
//    }

}
