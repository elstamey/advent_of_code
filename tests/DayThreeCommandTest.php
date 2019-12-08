<?php

use Acme\Console\Command\DayThreeCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayThreeCommandTest extends PHPUnit\Framework\TestCase
{

//    /** @test */
//    public function testExecute()
//    {
//        $application = new Application();
//        $application->add(new DayThreeCommand());
//
//        $command = $application->find('day3');
//        $commandTester = new CommandTester($command);
//        $commandTester->execute(array(
//            'command'  => $command->getName(),
//
//            // pass arguments to the helper
//            'inputFile' => 'testday3.txt',
//
//            // prefix the key with a double slash when passing options,
//            // e.g: '--some-option' => 'option_value',
//        ));
//
//
//        // the output of the command in the console
//        $output = $commandTester->getDisplay();
//        $this->assertContains('result = 0', $output);
//    }
//
//    /** @test */
//    public function testExecutePartTwo()
//    {
//        $application = new Application();
//        $application->add(new DayThreeCommand());
//
//        $command = $application->find('day3');
//        $commandTester = new CommandTester($command);
//        $commandTester->execute(array(
//            'command'  => $command->getName(),
//
//            // pass arguments to the helper
//            'inputFile' => 'testday3.txt',
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

    /** @test */
    function testGetManhattanDistance()
    {
        $command = new DayThreeCommand();

        $sample1 = 'R75,D30,R83,U83,L12,D49,R71,U7,L72';
        $sample1 = preg_split("/\,/", $sample1);

        $sample2 = 'U62,R66,U55,R34,D71,R55,D58,R83';
        $sample2 = preg_split("/\,/", $sample2);
//        var_dump($sample1, $sample2);

//        $this->assertEquals(159, $command->getManhattanDistance($sample1, $sample2));
    }

//    function testTakeStep()
//    {
//        $command = new DayThreeCommand();
//
//        $this->assertEquals([75, 0], $command->takeStep('R', 75));
//    }

}
