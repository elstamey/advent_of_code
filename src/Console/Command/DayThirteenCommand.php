<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
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
            $result = 0;
        } else {
            $this->initialSpace = [7,4];
            $this->initializeFloor(40,32);


            $result = $this->shortestPathBetween($this->initialSpace, [31,39]);
            $this->displayFloor();
        }
        $output->writeln("result = " . $result);
    }

    public function calculate($x, $y, $favoriteNumber)
    {
//        print "FAV NUM: ".$favoriteNumber."\n\n";
        $calculation = (($x * $x) + (3 * $x) + (2 * $x * $y) + $y + ($y * $y)) + $favoriteNumber;
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
            if (!empty(array_filter($row, function ($x) { return ($x !== ''); }))) {
                print $key . " ";
                foreach ($row as $space) {
                    print $space . " ";
                }
                print "\n";
            }
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
        $routes = [];

        $routes = $this->getPathsBetween($start, $destination);

        return (count($routes) - 1);
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

        $rangeX = range($start[0], $destination[0], 1);
        $rangeY = range($start[1], $destination[1], 1);
        $i = min($rangeX);
        $iMax = max($rangeX);
        $j = min($rangeY);
        $jMax = max($rangeY);

        while (($i <= $iMax) && ($j <= $jMax)) {
            $this->floor[$i][$j] = '0';

            $tempRoutes = $this->findOpenSpaces($i, $j, $iMax, $jMax);
            if (count($tempRoutes) === 1) {
                $i = $tempRoutes[0][0];
                $j = $tempRoutes[0][1];
            } else {
                $i++;
                $j++;
            }
            array_push($routes, $tempRoutes);
        }

        return $routes;
    }

    private function findOpenSpaces($x, $y, $xMax, $yMax)
    {
        $returnArray = [];
        if (isset($this->floor[($x+1)][$y]) && ($this->floor[($x+1)][$y] === '.')) {
            array_push($returnArray, [($x+1), $y]);
        }

         if (isset($this->floor[$x][($y+1)]) && ($this->floor[($x)][$y+1] === '.')) {
             array_push($returnArray, [$x, ($y+1)]);
         }

        if ($x > $xMax) {
            if (isset($this->floor[($x-1)][$y]) && ($this->floor[($x-1)][$y]) === '.') {
                array_push($returnArray, [($x-1), $y]);
            }
        }
        if ($y > $yMax) {
            if (isset($this->floor[($x)][$y-1]) && ($this->floor[($x)][$y-1] === '.')) {
                array_push($returnArray, [$x, ($y-1)]);
            }
        }

        return $returnArray;
    }

}