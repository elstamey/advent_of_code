<?php

use Acme\Console\Command\DayFourCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayFourCommandTest extends \PHPUnit_Framework_TestCase
{

    /** @test */
    public function testExecute()
    {
        $application = new Application();
        $application->add(new DayFourCommand());

        $command = $application->find('day4');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday4.txt',

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('result = 1514', $output);
    }
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

    /** @test */
    public function testIsRealRoom()
    {
        $command = new DayFourCommand();

        $this->assertTrue($command->isRealRoom('aaaaa-bbb-z-y-x-123[abxyz]'), 'Did not return true, expecting real room');
        $this->assertTrue($command->isRealRoom('a-b-c-d-e-f-g-h-987[abcde]'), 'Did not return true, expecting real room');
        $this->assertTrue($command->isRealRoom('not-a-real-room-404[oarel]'), 'Did not return true, expecting real room');
        $this->assertFalse($command->isRealRoom('totally-real-room-200[decoy]'), 'Got real room, expecting not real');

//        $this->assertEquals(1514, $command->getSectorSum(), 'Returned a Sum that did not match expectations');
    }

    /** @test */
    public function testDecryptName()
    {
        $command = new DayFourCommand();

        $this->assertContains('very encrypted name', $command->decryptName('qzmt-zixmtkozy-ivhz-343'), 'Did not see the name decrypted');

    }

}
