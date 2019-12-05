<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayThreeCommand extends Command
{
    protected $validTriangles = 0;

    protected function configure()
    {
        $this
            ->setName('day3')
            ->setDescription('Day 3: Crossed Wires')
            ->addArgument('inputFile', null, 'newFile', 'day3.txt')
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

//            $this->validTriangles = 0;
//
//            $groups = array_chunk(preg_split("/[\n]/", $this->input_string), 3);
//            foreach ($groups as $group) {
//
//                if (count($group) == 3) {
//                    $g = $group[0] . $group[1] . $group[2];
//
//                    if (isset($g) && ($g != "")) {
//                        $x = preg_split("/[\s]+/", $g);
//
//                        $this->testValidTriangle($x[1], $x[4], $x[7]);
//                        $this->testValidTriangle($x[2], $x[5], $x[8]);
//                        $this->testValidTriangle($x[3], $x[6], $x[9]);
//                    }
//                }
//            }

        } else {
            $values = [];

            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                    $steps = preg_split("/[\,]+/", $line);

                    $values = $this->getManhattanDistance($steps);
                }
            }

        }

        $result = $this->validTriangles;
        $output->writeln("result = " . $result);
    }


    /**
     * @param array $stepsA
     * @param array $stepsB
     * @return int
     */
    public function getManhattanDistance($stepsA, $stepsB)
    {
        list($xA, $yA) = $this->getCoordinates($stepsA);
        list($xB, $yB) = $this->getCoordinates($stepsB);


        $xDifference = $xA - $xB;
        var_dump($xA, $xB, $xDifference);
        $yDifference = $yA - $yB;
        var_dump($yA, $yB, $yDifference);
        return ($xDifference + $yDifference);
    }

    public function getCoordinates($steps)
    {
        $xDistance = 0;
        $yDistance = 0;

        foreach ($steps as $step) {
            $direction = substr($step, 0, 1);
            $amount = intval(substr($step, 1));

            switch ($direction) {
                case 'R':
                    $xDistance += $amount;
                    break;
                case 'L':
                    $xDistance -= $amount;
                    break;
                case 'U':
                    $yDistance += $amount;
                    break;
                case 'D':
                    $yDistance += $amount;
                    break;
            }
        }

        return [$xDistance, $yDistance];
    }

}
