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

    protected $oriented = [
        'aim' => 'N',
        'N' => 0,
        'S' => 0,
        'E' => 0,
        'W' => 0
    ];

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
                $result = $this->calculateNewLocation( $this->input_string );
            }
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
        foreach (preg_split("/, /", $input_string) as $dir) {
            if (isset($dir) && ($dir != "")) {
                $direction = substr($dir, 0 , 1);
                $distance = substr($dir, 1);

                switch ($direction) {
                    case 'L':
                        $this->turnLeft($this->oriented, $distance);
                    case 'R':
                        $this->turnRight($this->oriented, $distance);
                }

            }
        }

        $x = $this->oriented['N'] - $this->oriented['S'];
        $y = $this->oriented['E'] - $this->oriented['W'];

        print $x . " + " . $y . "\n";
        return abs($x) + abs($y);
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
     */
    private function turn($turnAmount, $origLocation, $distance)
    {
        $this->oriented['aim'] = $this->aimMe($turnAmount);

        $this->oriented[$this->oriented['aim']] += $distance;

        var_dump($this->oriented);

    }

    private function aimMe($turnAmount)
    {
        if ($turnAmount == -90) {
            switch ($this->oriented['aim']) {
                case 'N':
                    return 'W';
                case 'S':
                    return 'E';
                case 'E':
                    return 'N';
                case 'W':
                    return 'S';
            }
        } else {
            switch ($this->oriented['aim']) {
                case 'N':
                    return 'E';
                case 'S':
                    return 'W';
                case 'E':
                    return 'S';
                case 'W':
                    return 'N';
            }
        }
    }

}