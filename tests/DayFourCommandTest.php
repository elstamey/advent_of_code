<?php

use Acme\Console\Command\DayFourCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayFourCommandTest extends PHPUnit_Framework_TestCase
{



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

    public function testIsSixDigits()
    {
        $command = new DayFourCommand();

        $this->assertTrue($command->isSixDigits(240298), 'isSixDigits returned false');
        $this->assertTrue($command->isSixDigits(784956), 'isSixDigits returned false');
        $this->assertFalse($command->isSixDigits(7849560), 'isSixDigits returned true');
    }

    public function testIsWithinRange()
    {
        $command = new DayFourCommand();

        $this->assertTrue($command->isWithinRange(240298), 'isWithinRange returned false');
        $this->assertTrue($command->isWithinRange(784956), 'isWithinRange returned false');
        $this->assertTrue($command->isWithinRange(240299), 'isWithinRange returned false');
        $this->assertFalse($command->isWithinRange(784957), 'isWithinRange returned true');
        $this->assertFalse($command->isWithinRange(240297), 'isWithinRange returned true');
        $this->assertTrue($command->isWithinRange(784955), 'isWithinRange returned false');
    }

    public function testDigitsDontDecrease()
    {
        $command = new DayFourCommand();

        $this->assertTrue($command->digitsDontDecrease(245678), 'digitsDontDecrease returned false');
        $this->assertTrue($command->digitsDontDecrease(111111), 'digitsDontDecrease returned false');
        $this->assertFalse($command->digitsDontDecrease(240298), 'digitsDontDecrease returned true');
        $this->assertFalse($command->digitsDontDecrease(223450), 'digitsDontDecrease returned true');
    }

    public function testContainsDouble()
    {
        $command = new DayFourCommand();

        $this->assertTrue($command->containsDoubleDigits(223450), 'containsDoubleDigits returned false');
        $this->assertTrue($command->containsDoubleDigits(111111), 'containsDoubleDigits returned false');
        $this->assertFalse($command->containsDoubleDigits(240298), 'containsDoubleDigits returned true');
        $this->assertFalse($command->containsDoubleDigits(245678), 'containsDoubleDigits returned true');
    }

    public function testIsValidPassword()
    {
        $command = new DayFourCommand();

        $this->assertTrue($command->isValidPassword(333333), 'isValidPassword returned false');
        $this->assertFalse($command->isValidPassword(223450), 'isValidPassword returned true');
        $this->assertFalse($command->isValidPassword(123789), 'isValidPassword returned true');
    }


    public function testContainsDoublePartTwo()
    {
        $command = new DayFourCommand();

        $this->assertTrue($command->containsDoubleDigits(112233, true), 'containsDoubleDigits returned false');
        $this->assertTrue($command->containsDoubleDigits(111122, true), 'containsDoubleDigits returned false');
        $this->assertFalse($command->containsDoubleDigits(123444, true), 'containsDoubleDigits returned true');
    }
}
