<?php
/**
 * Created by PhpStorm.
 * User: elstamey
 * Date: 12/7/15
 * Time: 7:18 PM
 */

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayEightCommand extends Command
{
    /**
     * @var string
     */
    var $input_string = '';

    private $rectangle = [];


    protected function configure()
    {
        $this
            ->setName('day8')
            ->setDescription('The Ideal Stocking Stuffer')
            ->addArgument('inputFile', null, 'newFile', 'day8.txt')
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
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                }
            }
        } else {
            $this->initializeRectangle();
            $this->printRectangle();


            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                    $this->handleCommand($line);
                }
            }
        }
        $result = $this->countLights();
        $output->writeln("result = " . $result);
    }

    private function printRectangle()
    {
        foreach ($this->rectangle as $row) {
            foreach ($row as $space) {
                print " ". $space ." ";
            }
            print "\n";
        }
        print "\n";
    }

    private function initializeRectangle()
    {
        $x = [];
        $y = [];
        $x = array_pad($x, 50, '.');
        $y = array_pad($y, 6, $x);
        $this->rectangle = $y;
    }

    private function handleCommand($line)
    {
        $command = preg_split('/[\s]+/', $line, 2);

        if ($command[0] === 'rect') {

//            print strtoupper($command[0])." ".$command[1];
            $this->drawRectangle($command[1]);
        } elseif ($command[0] === 'rotate') {
//            var_dump($command);
            $this->rotate($command[1]);
        }
    }

    private function drawRectangle($restOfLine)
    {
//        var_dump($restOfLine);
        $coords = preg_split('/x/', $restOfLine);
//        print "RECT " . $coords[0] . " x " . $coords[1] . "\n";
        $x = $coords[0];
        $y = $coords[1];

        foreach ($this->rectangle as $keyA => $row) {
//            print implode(' ', $row) . "\n";
            if ($keyA < $y) {
                foreach ($row as $keyB => $space) {
                    if ($keyB < $x) {
//                        print $keyA."," . $keyB. "    ". $x .",".$y. "\n";
                        $this->rectangle[$keyA][$keyB] = '#';
                    }
                }
            }

        }

        $this->printRectangle();
//        die();
    }

    private function rotate($restOfLine)
    {
//        row y=0 by 2
        $command = preg_split('/[\s]/', $restOfLine);
        var_dump($command);
        $rowOrColumn = $command[0];
        $position = $command[1];
        $rotateAmount = $command[3];

        switch ($rowOrColumn) {
            case 'row':
                print "ROW ".$position." by ".$rotateAmount . "\n";
                $position = preg_split('/\=/', $position);
                $this->shiftRow($position[1], $rotateAmount);
                break;
            case 'column':
                print "COLUMN ".$position." by ".$rotateAmount . "\n";
                $position = preg_split('/\=/', $position);
                $this->shiftColumn($position[1], $rotateAmount);
                break;
        }
    }

    private function shiftRow($y, $rotateAmount)
    {
        $tempRow = array_pad([], 50, '');

        foreach ($this->rectangle[$y] as $key => $item) {
            $cnt = $key + $rotateAmount;
            if ( $cnt >= 50 ) {
                $cnt -= 50;
            }
            $tempRow[$cnt] = $item;
        }

//        print "row to shift" . implode(' ', $tempRow) ."\n";

        $this->rectangle[$y] = $tempRow;
        $this->printRectangle();
    }

    private function shiftColumn($x, $rotateAmount)
    {
        $tempColumn = array_pad([], 6, '');


        foreach ($this->rectangle as $key => $item) {
            $cnt = $key + $rotateAmount;
            if ( $cnt >= 6) {
                $cnt -= 6;
            }
            $tempColumn[$cnt] = $item[$x];
        }

        foreach ($this->rectangle as $key => $item) {
            $this->rectangle[$key][$x] = $tempColumn[$key];
        }

        $this->printRectangle();
    }

    private function countLights()
    {
        $numberOfLights = 0;
//        $wholeArray = [];
//
        foreach ($this->rectangle as $key => $item) {
//            $numberOfLights += array_walk($item, function($value) {
//                return ($item[$key] === '#');
//            });
            foreach ($item as $item2) {
                $numberOfLights += ($item2 === '#');
            }
        }

        return $numberOfLights;
    }

}