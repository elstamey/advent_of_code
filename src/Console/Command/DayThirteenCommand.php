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

    private $initialSpace = [1,1];
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
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                }
            }
        } else {
            $this->initializeFloor(40);
            $this->displayFloor();

            $this->shortestPathBetween($this->initialSpace, [31,39]);
        }
        $result = '';
        $output->writeln("result = " . $result);
    }

    public function calculate($x, $y)
    {
        $calculation = (($x*$x) + (2*$x*$y) + $y + ($y*$y)) + $this->inputString;
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
        return (($onesCount % 2) === 0) ? '#' : '.';
    }

    public function getRoomMarkerFor($x, $y)
    {
        return $this->getRoomMarker($this->countOnesInBinaryString($this->convertToBinary($this->calculate($x, $y))));
    }

    public function initializeFloor($count)
    {
        $x = [];
        $y = [];
        $x = array_pad($x, $count, '');
        $y = array_pad($y, $count, $x);

        foreach ($y as $key1 => $row) {
            foreach ($row as $key2 => $space) {
                $y[$key1][$key2] = $this->getRoomMarkerFor($key1,$key2);
            }
        }

        $this->floor = $y;
    }

    public function displayFloor()
    {
        foreach ($this->floor as $row) {
            foreach ($row as $space) {
                print $space . " ";
            }
            print "\n";
        }
    }

}