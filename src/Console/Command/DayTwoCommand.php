<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayTwoCommand extends Command
{

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
        $this->input_string = file_get_contents($input->getArgument('inputFile'));

        if ($input->getOption('part2')) {

            $result = $this->decode($this->input_string);
        } else {

            $result = $this->getResult($this->input_string);
        }

        $output->writeln("result = ".$result);
    }

    private function getResult($input_string)
    {
        $rowMath = [];

        foreach (preg_split("/\n/", $input_string) as $row) {

            array_push($rowMath, $this->getRowMath($row));
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

            $rowMath = $largest - $smallest;
        } else {
            $rowMath = 0;
        }

//        print 'row math = ' . $rowMath . "\n\n";

        return $rowMath;
    }

    public function getChecksum($rows)
    {
        return array_sum($rows);
    }
}