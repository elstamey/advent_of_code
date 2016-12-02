<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class DayOneCommand extends Command
{

    var $input_string = '';

    protected $oriented = 0;

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
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input_string = file_get_contents($input->getArgument('inputFile'));

        if ($input->getOption('part2')) {

        } else {
            if (isset($this->input_string)) {
                $newLocation = $this->calculateNewLocation( $this->input_string );
            }
            $result = abs($newLocation[0]) + abs($newLocation[1]);
        }

        $output->writeln("result = " . $result);
    }

    /**
     * @param $input_string
     *
     * @return array
     */
    private function calculateNewLocation($input_string)
    {
        $newLocation = ["0","0"];
        foreach (preg_split("/, /", $input_string) as $dir) {
            if (isset($dir) && ($dir != "")) {
                $direction = substr($dir, 0 , 1);
                $distance = substr($dir, 1);

                switch ($direction) {
                    case 'L':
                        $newLocation = $this->turnLeft($newLocation, $distance);
                    case 'R':
                        $newLocation = $this->turnRight($newLocation, $distance);
                }

            }
        }

        return $newLocation;
    }

    private function turnLeft($newLocation, $distance)
    {
        return $this->turn(-90, $newLocation, $distance);
    }

    private function turnRight($newLocation, $distance)
    {
        return $this->turn(90, $newLocation, $distance);
    }

    /**
     * @param $turnAmount
     * @param String[] $origLocation
     * @param int $distance
     *
     * @return array
     */
    private function turn($turnAmount, $origLocation, $distance)
    {
        print $origLocation[0] . "," . $origLocation[1]. " ". $this->oriented . " + ".$turnAmount. " + ". $distance;

        $newLocation = $origLocation;

        $this->oriented = $this->aimMe($turnAmount);

        print("oriented" . $this->oriented . "\n");

        switch ($this->oriented) {
            case 0:
                $newLocation[1] = bcadd($origLocation[1], $distance);
            case 90:
                $newLocation[0] = bcadd($origLocation[0], $distance);
            case -90:
                $newLocation[0] = bcsub($origLocation[0], $distance);
            case 180:
                $newLocation[1] = bcsub($origLocation[1], $distance);
            case -180:
                $newLocation[1] = bcadd($origLocation[1], $distance);
        }

        print $newLocation[0] . "," . $newLocation[1] . "\n\n";

        return $newLocation;

    }

    private function aimMe($turnAmount)
    {
        $oriented = $this->oriented + $turnAmount;

        if ($oriented >= 360)
            $oriented -= 360;
        elseif ($oriented <= -360)
            $oriented += 360;

        if ($oriented == 270)
            $oriented = -90;
        elseif ($oriented == -270)
            $oriented = 90;

        return $oriented;
    }



}