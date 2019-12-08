<?php

use Acme\Console\Command\DaySixCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DaySixCommandTest extends PHPUnit\Framework\TestCase
{

    public $password = 'foo';

    /** @test */
    public function testExecute()
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
        $this->assertContains('result = 5', $output);
    }

    /** @test */
    public function testExecutePartTwo()
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
        $this->assertContains('result = 4', $output);
    }

    public function testRedistribute()
    {
        $command = new DaySixCommand();

        $this->assertEquals([2, 4, 1, 2], $command->redistribute([0, 2, 7, 0]), 'Did not receive the expected redistribution');
        $this->assertEquals([3, 1, 2, 3], $command->redistribute([2, 4, 1, 2]), 'Did not receive the expected redistribution');
        $this->assertEquals([0, 2, 3, 4], $command->redistribute([3, 1, 2, 3]), 'Did not receive the expected redistribution');
        $this->assertEquals([1, 3, 4, 1], $command->redistribute([0, 2, 3, 4]), 'Did not receive the expected redistribution');
        $this->assertEquals([2, 4, 1, 2], $command->redistribute([1, 3, 4, 1]), 'Did not receive the expected redistribution');
    }

    public function testFindKeyOfLargest()
    {
        $command = new DaySixCommand();

        $this->assertEquals(3, $command->findKeyOfLargest([2, 5, 3, 9, 0, 3]), 'Did not return the expected key');
        $this->assertEquals(3, $command->findKeyOfLargest([2, 5, 3, 9, 0, 9]), 'Did not return the expected key');
        $this->assertEquals(0, $command->findKeyOfLargest([9, 5, 3, 9, 0, 3]), 'Did not return the expected key');
    }

    public function testCheckForPreviouslySeenConfig()
    {
        $command = new DaySixCommand();

        $command->photoAlbum = [
            '0 2 7 0',
            '2 4 1 2',
            '3 1 2 3',
            '0 2 3 4',
            '1 3 4 1'
        ];

        $this->assertTrue($command->checkForPreviouslySeenConfig([0, 2, 7, 0]), 'Did not receive the expected true');
        $this->assertFalse($command->checkForPreviouslySeenConfig([0, 2, 9, 0]), 'Did not receive the expected false');
        $this->assertTrue($command->checkForPreviouslySeenConfig([2, 4, 1, 2]), 'Did not receive the expected true');
        $this->assertTrue($command->checkForPreviouslySeenConfig([3, 1, 2, 3]), 'Did not receive the expected true');
        $this->assertTrue($command->checkForPreviouslySeenConfig([0, 2, 3, 4]), 'Did not receive the expected true');
        $this->assertTrue($command->checkForPreviouslySeenConfig([1, 3, 4, 1]), 'Did not receive the expected true');
    }

    public function testIsSameConfig()
    {
        $command = new DaySixCommand();

        $this->assertTrue($command->isSameConfig('0 2 7 0', [0, 2, 7, 0]), 'Did not receive the expected true');
        $this->assertFalse($command->isSameConfig('1 2 3 4', [0, 2, 9, 0]), 'Did not receive the expected false');
        $this->assertTrue($command->isSameConfig('2 4 1 2', [2, 4, 1, 2]), 'Did not receive the expected true');
        $this->assertTrue($command->isSameConfig('3 1 2 3', [3, 1, 2, 3]), 'Did not receive the expected true');
        $this->assertTrue($command->isSameConfig('0 2 3 4', [0, 2, 3, 4]), 'Did not receive the expected true');
        $this->assertTrue($command->isSameConfig('1 3 4 1', [1, 3, 4, 1]), 'Did not receive the expected true');
    }
}