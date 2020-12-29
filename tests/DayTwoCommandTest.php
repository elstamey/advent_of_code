<?php

use Acme\Console\Command\DayTwoCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayTwoCommandTest extends PHPUnit\Framework\TestCase
{
    /**
     * @return void
     */
    public function testExecute(): void
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
        self::assertStringContainsString('result = 2', $output);
    }

    public function testGetRange() : void
    {
        $testData = [
            '1-3',
            '1-3',
            '2-9'
        ];
        $command = new DayTwoCommand();

        self::assertEquals([1,3], $command->getRange($testData[0]));
        self::assertEquals([1,3], $command->getRange($testData[1]));
        self::assertEquals([2,9], $command->getRange($testData[2]));
    }

    public function testGetPositions() : void
    {
        $testData = [
            '1-3',
            '1-3',
            '2-9'
        ];
        $command = new DayTwoCommand();

        self::assertEquals([1,3], $command->getPositions($testData[0]));
        self::assertEquals([1,3], $command->getPositions($testData[1]));
        self::assertEquals([2,9], $command->getPositions($testData[2]));
    }
    public function testGetRepeatedLetter() : void
    {
        $testData = [
            'a:',
            'b:',
            'c:'
        ];
        $command = new DayTwoCommand();

        self::assertEquals('a', $command->getLetter($testData[0]));
        self::assertEquals('b', $command->getLetter($testData[1]));
        self::assertEquals('c', $command->getLetter($testData[2]));

    }

    public function testGetRepeatedLetters() : void
    {
        $testData = [
            'abcde',
            'bcdefg',
            'ccccccccc'
        ];

        $command = new DayTwoCommand();

        self::assertEquals(1, $command->countRepeatedLetters('a',$testData[0]));
        self::assertEquals(1, $command->countRepeatedLetters('b',$testData[1]));
        self::assertEquals(9, $command->countRepeatedLetters('c',$testData[2]));
    }

    public function testIsPasswordValid() : void
    {
        $testData = [
            '1-3 a: abcde',
            '1-3 b: cdefg',
            '2-9 c: ccccccccc'
        ];

        $command = new DayTwoCommand();

        self::assertTrue($command->isPasswordValid($testData[0]));
        self::assertFalse($command->isPasswordValid($testData[1]));
        self::assertTrue($command->isPasswordValid($testData[2]));
    }

    public function testIsPasswordOfficialTobogganCorpValid() : void
    {
        $testData = [
            '1-3 a: abcde',
            '1-3 b: cdefg',
            '2-9 c: ccccccccc'
        ];

        $command = new DayTwoCommand();

        self::assertTrue($command->isPasswordOfficialTobogganCorpValid($testData[0]));
        self::assertFalse($command->isPasswordOfficialTobogganCorpValid($testData[1]));
        self::assertFalse($command->isPasswordOfficialTobogganCorpValid($testData[2]));
    }

    public function testProcessPasswordsWithPolicies() : void
    {
        $testData = [
            '1-3 a: abcde',
            '1-3 b: cdefg',
            '2-9 c: ccccccccc'
        ];

        $command = new DayTwoCommand();

        self::assertEquals(2, $command->processPasswordsWithPolicies($testData));
    }

    public function testExecutePartTwo() : void
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
        self::assertStringContainsString('result = 1', $output);
    }

    public function testIsLetterAtOnlyOneOfPositionsInPassword() : void
    {
        $command = new DayTwoCommand();

        self::assertTrue($command->isLetterAtOnlyOneOfPositionsInPassword('a', [1, 3], 'abcde'));
        self::assertFalse($command->isLetterAtOnlyOneOfPositionsInPassword('b', [1, 3], 'cdefg'));
        self::assertFalse($command->isLetterAtOnlyOneOfPositionsInPassword('c', [2, 9], 'ccccccccc'));
    }
}
