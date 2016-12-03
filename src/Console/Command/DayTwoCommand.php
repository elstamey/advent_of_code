<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DayTwoCommand extends Command
{

    private $keypad = [
        [ 1, 2, 3 ],
        [ 4, 5, 6 ],
        [ 7, 8, 9 ]
    ];

    private $position = [1, 1];

    protected function configure()
    {
        $this
            ->setName('day2')
            ->setDescription('Day 2: Bathroom Security')
            ->addArgument('inputFile', null, 'newFile', 'day2.txt');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input_string = file_get_contents($input->getArgument('inputFile'));

        $result = $this->decode($this->input_string);

        $output->writeln("result = ".$result);
    }

    private function decode($input_string)
    {
        $keys = [];

        foreach (preg_split("/\n/", $input_string) as $line) {

            array_push($keys, $this->decodeKeyPress($line));
        }

//        print("keys: " . implode('', $keys) ."\n");

        return implode('', $keys);
    }

    private function decodeKeyPress($line)
    {
        $x = $this->position[0];
        $y = $this->position[1];

        if (isset($line) && ($line != "")) {
            print $line;

            $matches = str_split($line, 1);

            foreach ($matches as $m) {

                switch ($m) {
                    case 'U':
                        $x--;
                        if ($x < 0) {
                            $x = 0;
                        }
                        break;
                    case 'D':
                        $x++;
                        if ($x > 2) {
                            $x = 2;
                        }
                        break;
                    case 'L':
                        $y--;
                        if ($y < 0) {
                            $y = 0;
                        }
                        break;
                    case 'R':
                        $y++;
                        if ($y > 2) {
                            $y = 2;
                        }
                        break;
                }
//                print "(".$x. "," . $y . ") = ". $this->keypad[$x][$y];
                $this->position = [$x, $y];
            }


//        print "key: " . $this->keypad[$x][$y] . "\n";
            return $this->keypad[$x][$y];
        }

    }

}