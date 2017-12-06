<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayFiveCommand extends Command
{

    private $inputString;

    protected function configure()
    {
        $this
            ->setName('day5')
            ->setDescription('Day 5: A Maze of Twisty Trampolines, All Alike')
            ->addArgument('inputFile', null, 'newFile', 'day5.txt')
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->inputString = file_get_contents($input->getArgument('inputFile'));

        if ($input->getOption('part2')) {

            $result = 0;

        } else {

            $result = $this->traverseJumpInstructions(preg_split("/\n/", $this->inputString, null, PREG_SPLIT_NO_EMPTY));

        }

        $output->writeln("result = " . $result);
    }

    public function traverseJumpInstructions($instructions)
    {
        $stepCount = 0;
        $pos = 0;
        $max = count($instructions) - 1;

        while (in_array($pos, range(0, $max)) && isset($instructions[$pos])) {
            $jmp = $instructions[$pos];
            $instructions[$pos]++;
            $pos += $jmp;
            $stepCount++;
        }

        return $stepCount;
    }
}