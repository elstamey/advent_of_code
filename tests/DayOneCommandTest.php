<?php
/**
 * Class DayOneCommandTest
 *
 * @author  Emily Stamey
 */

use Acme\Console\Command\DayOneCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayOneCommandTest extends PHPUnit\Framework\TestCase
{

    /** @test */
    public function testExecute() : void
    {
        $application = new Application();
        $application->add(new DayOneCommand());

        $command = $application->find('day1');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday1.txt',

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('result part 1 = 514579', $output);
    }

    /** @test */
    public function testExecutePartTwo() : void
    {
        $application = new Application();
        $application->add(new DayOneCommand());

        $command = $application->find('day1');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday1.txt',

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
            '--part2' => true,

        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('result part 2 = 241861950', $output);
    }
}
