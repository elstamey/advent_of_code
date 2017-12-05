<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayThreeCommand extends Command
{

    private $returnFrom = 0;

    public function getPositionOfSquare($square)
    {
        $grid = $this->buildGridUpToSquare($square);

        return [0, 0];
    }

    protected function configure()
    {
        $this
            ->setName('day3')
            ->setDescription('Day 3: Spiral Memory')
            ->addArgument('square', InputArgument::REQUIRED, 'What square do you want to return from?')
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->returnFrom = $input->getArgument('square');

        if ($input->getOption('part2')) {

            $result = 0;

        } else {

            $returnFromPosition = [0, 0];

            $this->buildGridUpToSquare($this->returnFrom);

            $result = $this->manhattanDistance([0,0], $returnFromPosition);

        }


        $output->writeln("result = " . $result);
    }

    /**
     * Method to solve the Manhattan Distance between two points
     *
     * each point is an array containing [x,y]
     * @param array $pointA
     * @param array $pointB
     *
     * @return float|int
     */
    public function manhattanDistance($pointA, $pointB)
    {
        return abs($pointA[0] - $pointB[0]) + abs($pointA[1] - $pointB[1]);
    }

    public function buildGridUpToSquare($square)
    {
        $rows[][] = 0;

        $value = 1;
        $steps = 1;
        $direction = 1;
        $x = 0;
        $y = 0;

        while ($value < $square) {

            switch ($direction):
                case 1:
                    for ($i=0; $i < $steps; $i++) {
                        array_push($rows[0], $value);
                        $value++;
                    }
                    $direction++;
                    break;
                case 2:
                    array_unshift($rows, []);
                    for ($i=0; $i < $steps; $i++) {
                        array_unshift($rows[0], $value);
                        $value++;
                    }
                    $steps++;
                    $direction++;
                    break;
                case 3:
                    for ($i=0; $i < $steps; $i++) {
                        array_unshift($rows[$i], $value);
                        $value++;
                    }
                    $direction++;
                    break;
                case 4:
                    $count = count($rows) - 1;
                    for ($i=0; $i < $steps; $i++) {
                        array_push($rows[$count], $value);
                    }
                    $steps++;
                    $direction = 1;
                    break;
                endswitch;

        }

        $this->printMatrix($rows);
        return $rows;
    }

    private function printMatrix($rows)
    {
        foreach ($rows as $row) {
            $line = implode('  ', $row);
            print $line . "\n";
        }
    }
}
