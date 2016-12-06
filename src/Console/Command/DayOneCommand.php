<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class DayOneCommand extends Command
{
    private $positionX = 0;
    private $positionY = 0;
    private $oriented = 1;

    private $previousPositions = ["(0,0)"];

    const NORTH = 1;
    const EAST = 2;
    const SOUTH = 3;
    const WEST = 4;

    private $input_string = '';


    protected function configure()
    {
        $this
            ->setName('day1')
            ->setDescription('No Time for a Taxicab')
            ->addArgument('inputFile', null, 'newFile', 'day1.txt')
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
            if (isset($this->input_string)) {
                $result = $this->calculateRepeatVisits( $this->input_string );
            }
        } else {
            if (isset($this->input_string)) {
                $result = $this->calculateNewLocation( $this->input_string );
            }
        }

        $output->writeln("result = " . $result);
    }

    /**
     * @param string $input_string
     *
     * @return int
     */
    private function calculateNewLocation($input_string)
    {
        $moves = explode(', ', $input_string);
        foreach ($moves as $move) {
            preg_match('#([R|L])(\d+)#', $move, $matches);
            $direction = $matches[1];
            $distance = $matches[2];

            print "input: " . $move . "  split: " . $direction . " " . $distance . "    \n";
            $this->turn($direction, $distance);

            print "(" . $this->positionX . ", " . $this->positionY . ")\n";
        }

        return (abs($this->positionX) + abs($this->positionY));
    }


    /**
     * @param string $input_string
     *
     * @return int
     */
    private function calculateRepeatVisits($input_string)
    {
        $moves = explode(', ', $input_string);
        foreach ($moves as $move) {
            preg_match('#([R|L])(\d+)#', $move, $matches);
            $direction = $matches[1];
            $distance = $matches[2];

            print "input: " . $move . "  split: " . $direction . " " . $distance . "    \n";
            $this->turn($direction, $distance);

            print "(" . $this->positionX . ", " . $this->positionY . ")\n";

            var_dump($this->previousPositions);
        }

        return (abs($this->positionX) + abs($this->positionY));
    }

    /**
     * @param int $turnDirection
     * @param int $distance
     *
     * @internal param $turnAmount
     */
    private function turn($turnDirection, $distance)
    {

        $this->oriented = $this->aimMe($turnDirection);

        while (($distance > 0) && $this->hasNotVisited($this->positionX, $this->positionY)) {

            switch ($this->oriented) {
                case self::NORTH:
                    $this->positionY = $this->positionY + 1;
                    break;
                case self::SOUTH:
                    $this->positionY = $this->positionY - 1;
                    break;
                case self::EAST:
                    $this->positionX = $this->positionX + 1;
                    break;
                case self::WEST:
                    $this->positionX = $this->positionX - 1;
                    break;
            }

            $distance--;

            var_dump($this->previousPositions);
        }
    }


    private function aimMe($turnDirection)
    {

        $turnAmount = 0;
        switch ($turnDirection) {
            case 'L':
                $turnAmount = 0-1;
                break;
            case 'R':
                $turnAmount = 1;
                break;
        }

        $newDirection = $this->oriented + $turnAmount;

        if ($newDirection > 4) {
            $newDirection = 1;
        } elseif ($newDirection < 1) {
            $newDirection = 4;
        }

        print("currAim: " . $this->oriented . " turnDir ".$turnDirection . " amt: " . $turnAmount . " newDir " . $newDirection . "\n");


        return $newDirection;
    }

    private function hasNotVisited($positionX, $positionY)
    {
        $searchString = "(" . $this->positionX . ", " . $this->positionY . ")";
        $returnValue = (array_search($searchString, $this->previousPositions) === false);
        array_push($this->previousPositions, "(" . $this->positionX . ", " . $this->positionY . ")");

        return $returnValue;
    }

}