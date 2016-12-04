<?php

use Acme\Console\Command\DayThreeCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayThreeCommandTest extends \PHPUnit_Framework_TestCase
{

    /** @test */
    public function testExecute()
    {
        $application = new Application();
        $application->add(new DayThreeCommand());

        $command = $application->find('day3');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday3.txt',

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('result = 0', $output);
    }

}
