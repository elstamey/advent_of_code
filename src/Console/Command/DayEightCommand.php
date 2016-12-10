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
        $result = '';
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
//            var_dump($command);
//            print strtoupper($command[0])." ".$command[1];
            $this->drawRectangle($command[1]);
        }
    }

    private function drawRectangle($restOfLine)
    {
//        var_dump($restOfLine);
        $coords = preg_split('/x/', $restOfLine);
        print "RECT " . $coords[0] . " x " . $coords[1] . "\n";
        $x = $coords[0];
        $y = $coords[1];

        foreach ($this->rectangle as $keyY => $row) {
//            print implode(' ', $row) . "\n";
            if ($keyY < $y) {
                foreach ($row as $keyX => $space) {
                    if ($keyX < $x) {
                        print $keyY."," . $keyX. "    ". $x .",".$y. "\n";
                        $this->rectangle[$keyY][$keyX] = '#';
                    }
                }
            }

        }

        $this->printRectangle();
//        die();
    }

}