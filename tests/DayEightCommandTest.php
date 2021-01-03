<?php

use Acme\Console\Command\DayEightCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayEightCommandTest extends PHPUnit\Framework\TestCase
{

    /** @test */
    public function testExecute() : void
    {
        $application = new Application();
        $application->add(new DayEightCommand());

        $command = $application->find('day8');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'   => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday8.txt',

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('result = 5', $output);
    }

    /** @test */
    public function testExecutePartTwo() : void
    {
        $application = new Application();
        $application->add(new DayEightCommand());

        $command = $application->find('day8');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'   => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday8.txt',

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
            '--part2'   => true,
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('result = 8', $output);
    }

    public function testGetReplacePositions(): void
    {
        $inputArray = ['nop +0',
                        'acc +1',
                        'jmp +4',
                        'acc +3',
                        'jmp -3',
                        'acc -99',
                        'acc +1',
                        'jmp -4',
                        'acc +6'];

        $command = new DayEightCommand();
        $result = $command->getReplacePositions($inputArray);
        self::assertEquals([0, 2, 4, 7], $result);
    }
}