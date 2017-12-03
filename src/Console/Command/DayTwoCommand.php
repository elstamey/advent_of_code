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
            ->setDescription('Day 2: Corruption Checksum')
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

        if ($input->getOption('part2')) {
            $output->writeln('result = ' . $this->getDivisibleChecksum($this->inputString));
        } else {
            $output->writeln('result = ' . $this->getDifferenceChecksum($this->inputString));
        }
    }

    private function getDifferenceChecksum($inputString)
    {
        $rowMath = [];

        foreach (preg_split("/\n/", $inputString) as $row) {

            array_push($rowMath, $this->getRowMath($row));
        }

        return $this->getChecksum($rowMath);
    }

    private function getDivisibleChecksum($inputString)
    {
        $rowMath = [];

        foreach (preg_split("/\n/", $inputString) as $row) {

            array_push($rowMath, $this->getDivisibleRow($row));
        }

        return $this->getChecksum($rowMath);
    }

    public function getRowMath($row)
    {
        $largest = 0;
        $smallest = 100000000000000;

//        $row = preg_replace('/\s/', '', $row);

//        print($row . "\n");

        if (!empty($row)) {

            $numbers = preg_split('/\s/', $row);

            foreach ($numbers as $digit) {
//                print '- ' . $digit . '(' . $largest . ', ' . $smallest . ")\n";
                $largest = ($digit > $largest) ? $digit : $largest;
                $smallest = ($digit < $smallest) ? $digit : $smallest;
            }

            return ($largest - $smallest);
        }

        return 0;
    }

    public function getChecksum($rows)
    {
        return array_sum($rows);
    }

    public function getDivisibleRow($row)
    {
        if (!empty($row)) {

            $numbers = preg_split('/\s/', $row);

            foreach ($numbers as $left) {
                foreach ($numbers as $right) {
                    if (($left > $right) && (($left % $right) === 0)) {
                        return ($left / $right);
                    } elseif (($right > $left) && (($right % $left) === 0)) {
                        return ($right / $left);
                    }
                }
            }
        }

        return 0;
    }
}