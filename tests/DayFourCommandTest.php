<?php

use Acme\Console\Command\DayFourCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayFourCommandTest extends \PHPUnit_Framework_TestCase
{

    /** @test */
//    public function testExecute()
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
//        ));
//
//
//        // the output of the command in the console
//        $output = $commandTester->getDisplay();
//        $this->assertContains('result = 1514', $output);
//    }
//
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

    public function testIsValidPassword()
    {
        $command = new DayFourCommand();

        $this->assertTrue($command->isValidPassword('aa bb cc dd ee'), 'isValidPassword returned invalid');
        $this->assertFalse($command->isValidPassword('aa bb cc dd aa'), 'isValidPassword returned valid');
        $this->assertTrue($command->isValidPassword('aa bb cc dd aaa'), 'isValidPassword returned invalid');
    }

    public function testPasswordDoesNotContainAnagrams()
    {
        $command = new DayFourCommand();

        $this->assertTrue($command->passwordDoesNotContainAnagrams('abcde fghij'), 'passwordDoesNotContainAnagrams returned invalid');
        $this->assertFalse($command->passwordDoesNotContainAnagrams('abcde xyz ecdab'), 'passwordDoesNotContainAnagrams returned valid');
        $this->assertTrue($command->passwordDoesNotContainAnagrams('a ab abc abd abf abj'), 'passwordDoesNotContainAnagrams returned invalid');
        $this->assertTrue($command->passwordDoesNotContainAnagrams('iiii oiii ooii oooi oooo'), 'passwordDoesNotContainAnagrams returned invalid');
        $this->assertFalse($command->passwordDoesNotContainAnagrams('oiii ioii iioi iiio'), 'passwordDoesNotContainAnagrams returned valid');

    }
}
