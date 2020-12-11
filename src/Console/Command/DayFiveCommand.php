<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayFiveCommand extends Command
{

    /**
     * @var string
     */
    private string $inputString;

    protected function configure() : void
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

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $this->inputString = file_get_contents($input->getArgument('inputFile'));

        $instructions = preg_split("/\n/", $this->inputString, null, PREG_SPLIT_NO_EMPTY);

        $result = $this->traverseJumpInstructions($instructions, $input->getOption('part2'));

        $output->writeln("result = " . $result);
    }

    /**
     * @param false|string[] $instructions
     * @param bool $partTwoRule
     *
     * @return int
     *
     * @psalm-return 0|positive-int
     */
    public function traverseJumpInstructions($instructions, bool $partTwoRule=false)
    {
        $stepCount = 0;
        $pos = 0;
        $max = count($instructions) - 1;

        while (in_array($pos, range(0, $max), true) && isset($instructions[$pos])) {
            $offset = $instructions[$pos];
            $instructions[$pos] = $this->replaceOffset($offset, $partTwoRule);
            $pos += $offset;
            $stepCount++;
        }

        return $stepCount;
    }

    /**
     * @param string                    $offset
     * @param bool|null|string|string[] $partTwoRule
     *
     * @return int
     */
    public function replaceOffset(string $offset, $partTwoRule) : int
    {
        $offset = intval($offset);
        if ($partTwoRule && $offset >= 3) {
            return ($offset - 1);
        }

        return ($offset + 1);
    }
}