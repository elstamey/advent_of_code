<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayThirteenCommand extends Command
{
    /**
     * @var string
     */
    var $inputString = '1364';

    /**
     * @var array
     */
    var $initialSpace = [1,1];

    /**
     * @var array
     */
    private $floor = [];


    protected function configure()
    {
        $this
            ->setName('day13')
            ->setDescription('The Ideal Stocking Stuffer')
            ->addArgument('inputFile', null, 'newFile', 'day13.txt')
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('part2')) {
            foreach (preg_split("/\n/", $this->inputString) as $line) {
                if (isset($line) && ($line != "")) {
                }
            }
        } else {
            $this->initialSpace = [7,4];
            $this->initializeFloor(40,32);
            $this->displayFloor();

            $shortestPath = $this->shortestPathBetween($this->initialSpace, [31,39]);
        }
        $result = $shortestPath;
        $output->writeln("result = " . $result);
    }

    public function calculate($x, $y, $favoriteNumber)
    {
//        print "FAV NUM: ".$favoriteNumber."\n\n";
        $calculation = (($x*$x) + (2*$x*$y) + $y + ($y*$y)) + $favoriteNumber;
        return $calculation;
    }


    public function convertToBinary($number)
    {
        return decbin($number);
    }

    public function countOnesInBinaryString($binaryString)
    {
        $bits = str_split(strval($binaryString));

        $countedBits = array_count_values($bits);

        return $countedBits[1];
    }

    public function getRoomMarker($onesCount)
    {
        return (($onesCount % 2) === 0) ? '.' : '#';
    }

    public function getRoomMarkerFor($x, $y)
    {
        return $this->getRoomMarker(
            $this->countOnesInBinaryString(
                $this->convertToBinary(
                    $this->calculate($x, $y, $this->inputString)
                )
            )
        );
    }

    public function initializeFloor($countY, $countX)
    {
        $x = [];
        $y = [];
        $x = array_pad($x, $countX, '');
        $y = array_pad($y, $countY, $x);

        foreach ($y as $key1 => $row) {
            foreach ($row as $key2 => $space) {
                $y[$key2][$key1] = $this->getRoomMarkerFor($key1,$key2);
            }
        }

        $this->floor = $y;
    }

    public function displayFloor()
    {
        print "\n";
        print "  0 1 2 3 4 5 6 7 8 9\n";
        foreach ($this->floor as $key => $row) {
            print $key . " ";
            foreach ($row as $space) {
                print $space . " ";
            }
            print "\n";
        }
    }

    /**
     * @param int[] $start
     * @param int[] $destination
     *
     * @return int
     */
    public function shortestPathBetween($start, $destination)
    {
        $routeLengths = [];

        $routes = $this->getPathsBetween($start, $destination);

        array_push($routeLengths, $routes[0]);

        return min($routeLengths);
    }

    /**
     * @param int[] $start
     * @param int[] $destination
     *
     * @return array
     */
    public function getPathsBetween($start, $destination)
    {
        $routes = [];



        return $routes;
    }

}