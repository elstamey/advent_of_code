<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayTwoCommand extends Command
{
    private $inputString = '';

    protected function configure()
    {
        $this
            ->setName('day2')
            ->setDescription('Day 2: Inventory Management System')
            ->addArgument('inputFile', null, 'newFile', 'day2.txt')
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

        if (isset($this->inputString) && $input->getOption('part2')) {

//            $output->writeln('result = ' . $this->getDivisibleChecksum($this->inputString));
            return;

        } elseif (isset($this->inputString)) {

            $output->writeln('result = ' . $this->getChecksum());
            return;

        }

        $output->writeln('<error>Could not execute</error>');
    }


    /**
     * The checksum = a * b where
     *   a = the number of boxIds that contain 2 of a letter
     *   b = the number of boxIds that contain 3 of a letter
     *
     * @param $inputString
     *
     * @return int
     */
    private function getChecksum()
    {
        list($twiceBoxIdCount, $thriceBoxIdCount) = $this->getTwiceAndThriceBoxIdCounts();

        return ($twiceBoxIdCount * $thriceBoxIdCount);
    }

    public function getDivisibleRow($row)
    {
        if (!empty($row)) {

            $numbers = preg_split('/\s/', $row);

            foreach ($numbers as $left) {
                foreach ($numbers as $right) {
                    if ($left !== $right) {
                        if (($left > $right) && (($left % $right) === 0)) {
                            return ($left / $right);
                        } elseif (($right > $left) && (($right % $left) === 0)) {
                            return ($right / $left);
                        }
                    }
                }
            }
        }

        return 0;
    }

    private function getTwiceAndThriceBoxIdCounts()
    {
        $twiceBoxIdCount = 0;
        $thriceBoxIdCount = 0;

        foreach (explode("\n", $this->inputString) as $row) {

            $chars = preg_split('//', $row, -1,  PREG_SPLIT_NO_EMPTY);

            $counts = array_count_values($chars);

            $twiceBoxIdCount += in_array(2, $counts, true) ? 1 : 0;
            $thriceBoxIdCount += in_array(3, $counts, true) ? 1 : 0;
        }

        return [$twiceBoxIdCount, $thriceBoxIdCount];
    }
}