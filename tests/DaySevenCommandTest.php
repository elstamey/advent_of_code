<?php

use Acme\Console\Command\DaySevenCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DaySevenCommandTest extends PHPUnit\Framework\TestCase
{

    public $password = 'foo';

    /** @test */
    public function testExecute()
    {
//        $application = new Application();
//        $application->add(new DaySevenCommand());
//
//        $command = $application->find('day7');
//        $commandTester = new CommandTester($command);
//        $commandTester->execute(array(
//            'command'  => $command->getName(),
//
//            // pass arguments to the helper
//            'inputFile' => 'testday7.txt',
//
//            // prefix the key with a double slash when passing options,
//            // e.g: '--some-option' => 'option_value',
//        ));
//
//
//        // the output of the command in the console
//        $output = $commandTester->getDisplay();
//        $this->assertContains('result = 2', $output);
    }

    /** @test */
    public function testExecutePartTwo()
    {
//        $application = new Application();
//        $application->add(new DaySevenCommand());
//
//        $command = $application->find('day7');
//        $commandTester = new CommandTester($command);
//        $commandTester->execute(array(
//            'command'  => $command->getName(),
//
//            // pass arguments to the helper
//            'inputFile' => 'testday7b.txt',
//
//            // prefix the key with a double slash when passing options,
//            // e.g: '--some-option' => 'option_value',
//            '--part2' => true,
//        ));
//
//
//        // the output of the command in the console
//        $output = $commandTester->getDisplay();
//        $this->assertContains('result = 3', $output);
    }

    public function testIsAbba()
    {
        $testAbbaStrings = ['abba', 'poop','ioxxoj'];
        $testNotAbbaStrings = ['dogs', 'test', 'aaaa'];

        $command = new DaySevenCommand();

        foreach ($testAbbaStrings as $test) {
            $this->assertTrue($command->isAbba($test), 'expected string to pass '.$test);
        }

        foreach ($testNotAbbaStrings as $test) {
            $this->assertFalse($command->isAbba($test), 'expected string to fail '.$test);
        }
    }

    public function testSupportsTls()
    {
        $passingLines = ['abba[mnop]qrst','ioxxoj[asdfgh]zxcvbn'];
        $failingLines = ['abcd[bddb]xyyx', 'aaaa[qwer]tyui'];

        $command = new DaySevenCommand();

        foreach ($passingLines as $passLine) {
            $this->assertTrue($command->supportsTLS($passLine), 'expecting string to pass '.$passLine);
        }

        foreach ($failingLines as $failLine) {
            $this->assertFalse($command->supportsTLS($failLine), 'expecting string to fail '.$failLine);
        }
    }

    public function testGetAbasFromString()
    {
        $command = new DaySevenCommand();

        $this->assertEquals(['aba'], $command->getAbasFromString('aba'.'xyz'), 'Did not find matching aba');
        $this->assertEquals(['bab'], $command->getAbasFromString('bab'), 'Did not find matching bab');
        $this->assertEquals(['xyx','xyx'], $command->getAbasFromString('xyx'.'xyx'), 'Did not find matching xyx');
        $this->assertEquals(['eke'], $command->getAbasFromString('aaa'.'eke'), 'Did not find matching eke');
        $this->assertEquals(['kek'], $command->getAbasFromString('kek'), 'Did not find matching kek');
        $this->assertEquals(['zaz','zbz'], $command->getAbasFromString('zazbz'.'cdb'), 'Did not find matching zbz and zaz in zazbz');
        $this->assertEquals(['bzb'], $command->getAbasFromString('bzb'), 'Did not find matching bzb');
    }

}
