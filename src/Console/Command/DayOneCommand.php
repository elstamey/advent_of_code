<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class DayOneCommand extends Command
{
    /**
     * @var string
     */
    private string $inputString = '';


    /**
     *
     */
    protected function configure() : void
    {
        $this
            ->setName('day1')
            ->setDescription('Day 1: Report Repair')
            ->addArgument('inputFile', InputArgument::OPTIONAL, 'newFile', 'day1.txt')
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
     *
     * @psalm-return 0|1
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $file = $input->getArgument('inputFile');
        if (is_string($file) )
            $this->inputString = file_get_contents($file);

        if (is_string($this->inputString) && $input->getOption('part2')) {

            $result = $this->findProductOfThreeSumTwentyTwenty( $this->inputString );
            $output->writeln('<fg=green>result part 2 = ' . $result . "\n");
            return Command::SUCCESS;

        } elseif (isset($this->inputString)) {

            $result = $this->findProductOfTwoSumTwentyTwenty($this->inputString);
            $output->writeln('<fg=green>result part 1 = ' . $result . '</>');
            return Command::SUCCESS;
        }

        $output->writeln('<error>Could not execute</error>');
        return Command::FAILURE;
    }


    /**
     * @param string $inputString
     *
     * @return int[]
     */
    private function splitInputByLinesToArray(string $inputString) : array
    {
        return array_map('intval', preg_split("/[\n]/", $inputString));
    }

    /**
     *  Method to get the the product of the digits that add up to 2020
     *
     * @param string $inputString
     *
     * @return int
     */
    private function findProductOfTwoSumTwentyTwenty(string $inputString)
    {
        $digits = $this->splitInputByLinesToArray($inputString);
        $count = count($digits) - 1;
        for ($i=0; $i < $count; $i++) {
            if (isset($digits[$i])) {
                $numberNeeded = 2020 - $digits[$i];
                $key = array_search($numberNeeded, $digits);
                if ($key && ($key !== $i)) {
                    return ($digits[$i] * $digits[$key]);
                }
            }
        }

        return 50;
    }

    /**
     * @param string $inputString
     *
     * @return int
     */
    private function findProductOfThreeSumTwentyTwenty(string $inputString) : int
    {
        $digits = $this->splitInputByLinesToArray($inputString);
        $count = count($digits) - 1;
        for ($i=0; $i < $count; $i++) {
            for ($j=0; ($i!=$j) && $j < $count; $j++) {
                $numberNeeded = 2020 - $digits[$i] - $digits[$j];
                $digits2 = array_filter($digits, function (int $k) use ($i, $j) { return (($k !== $i) && ($k !== $j)); }, ARRAY_FILTER_USE_KEY);
                $key = array_search($numberNeeded, $digits2);
                if ($key && ($digits[$i] != 0) && ($digits[$j] != 0) && ($digits2[$key] != 0)) {
                    return ($digits[$i] * $digits[$j] * $digits2[$key]);
                }
            }
        }

        return 50;
    }

}