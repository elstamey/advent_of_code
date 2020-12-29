<?php

use Acme\Console\Command\DaySevenCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DaySevenCommandTest extends PHPUnit\Framework\TestCase
{

    /** @test */
    public function testExecute(): void
    {
        $application = new Application();
        $application->add(new DaySevenCommand());

        $command = $application->find('day7');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday7.txt',

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('result = 4', $output);
    }

    /** @test */
    public function testExecutePartTwoFirstRules(): void
    {
        $application = new Application();
        $application->add(new DaySevenCommand());

        $command = $application->find('day7');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday7.txt',

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
            '--part2' => true,
        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('result = 32', $output);
    }

    /** @test */
    public function testExecutePartTwoSecondRules(): void
    {
        $application = new Application();
        $application->add(new DaySevenCommand());

        $command = $application->find('day7');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday7b.txt',

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
            '--part2' => true,
        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('result = 126', $output);
    }


}