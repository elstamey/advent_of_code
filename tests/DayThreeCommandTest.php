<?php

use Acme\Console\Command\DayThreeCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayThreeCommandTest extends PHPUnit\Framework\TestCase
{

//    /** @test */
//    public function testExecute()
//    {
//        $application = new Application();
//        $application->add(new DayThreeCommand());
//
//        $command = $application->find('day3');
//        $commandTester = new CommandTester($command);
//        $commandTester->execute(array(
//            'command'  => $command->getName(),
//
//            // pass arguments to the helper
//            'inputFile' => 'testday3.txt',
//
//            // prefix the key with a double slash when passing options,
//            // e.g: '--some-option' => 'option_value',
//        ));
//
//
//        // the output of the command in the console
//        $output = $commandTester->getDisplay();
//        $this->assertContains('result = 0', $output);
//    }
//
//    /** @test */
//    public function testExecutePartTwo()
//    {
//        $application = new Application();
//        $application->add(new DayThreeCommand());
//
//        $command = $application->find('day3');
//        $commandTester = new CommandTester($command);
//        $commandTester->execute(array(
//            'command'  => $command->getName(),
//
//            // pass arguments to the helper
//            'inputFile' => 'testday3.txt',
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

    /**
     * @var array|string[]
     */
    private array $inputLines = [
        '..##.......',
        '#...#...#..',
        '.#....#..#.',
        '..#.#...#.#',
        '.#...##..#.',
        '..#.##.....',
        '.#.#.#....#',
        '.#........#',
        '#.##...#...',
        '#...##....#',
        '.#..#...#.#'
    ];

    /**
     * @test
     */
    public function testPrepareMap() : void
    {
        $command = new DayThreeCommand();

        $expectedResults = [
            '..##.........##.........##.........##.......',
            '#...#...#..#...#...#..#...#...#..#...#...#..',
            '.#....#..#..#....#..#..#....#..#..#....#..#.',
            '..#.#...#.#..#.#...#.#..#.#...#.#..#.#...#.#',
            '.#...##..#..#...##..#..#...##..#..#...##..#.',
            '..#.##.......#.##.......#.##.......#.##.....',
            '.#.#.#....#.#.#.#....#.#.#.#....#.#.#.#....#',
            '.#........#.#........#.#........#.#........#',
            '#.##...#...#.##...#...#.##...#...#.##...#...',
            '#...##....##...##....##...##....##...##....#',
            '.#..#...#.#.#..#...#.#.#..#...#.#.#..#...#.#'
        ];

        $this->assertEquals($expectedResults, $command->prepareMap($this->inputLines));
    }

    /**
     * @test
     */
    function testTakeStep() : void
    {
        $command = new DayThreeCommand();

        $posX = 0;
        $posY = 0;
        $this->assertEquals([3, 1], $command->takeStep($posX, $posY));
    }

    /**
     * @test
     */
    public function testIsTree() : void
    {
        $command = new DayThreeCommand();

        $this->assertFalse($command->isTree('.'));

        $this->assertTrue($command->isTree('#'));
    }
}
