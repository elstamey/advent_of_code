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
    public function testExecutePartTwo(): void
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

    public function testBuildRuleset(): void
    {
        $testRules = 'light red bags contain 1 bright white bag, 2 muted yellow bags.
dark orange bags contain 3 bright white bags, 4 muted yellow bags.
bright white bags contain 1 shiny gold bag.
muted yellow bags contain 2 shiny gold bags, 9 faded blue bags.
shiny gold bags contain 1 dark olive bag, 2 vibrant plum bags.
dark olive bags contain 3 faded blue bags, 4 dotted black bags.
vibrant plum bags contain 5 faded blue bags, 6 dotted black bags.
faded blue bags contain no other bags.
dotted black bags contain no other bags.';


        $handledRules = [
            'light red bags' => ['bright white bag', 'muted yellow bags'],
            'dark orange bags' => ['bright white bags', 'muted yellow bags'],
            'bright white bags' => ['shiny gold bag'],
            'muted yellow bags' => ['shiny gold bags', 'faded blue bags'],
            'shiny gold bags' => ['dark olive bag', 'vibrant plum bags'],
            'dark olive bags' => ['faded blue bags', 'dotted black bags'],
            'vibrant plum bags' => ['faded blue bags', 'dotted black bags'],
            'faded blue bags' => ['no other bags'],
            'dotted black bags' => ['no other bags.']
        ];

        $command = new DaySevenCommand();

        $this->assertEquals($handledRules, $command->buildRuleset($testRules));


    }
}