<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayTwoCommand extends Command
{

    private $keypad = [];

    private $position = [1, 1];

    protected function configure()
    {
        $this
            ->setName('day2')
            ->setDescription('Day 2: Bathroom Security')
            ->addArgument('inputFile', null, 'newFile', 'day2.txt')
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
            $this->keypad = [
                [ null, null, 1, null, null ],
                [ null, 2, 3, 4, null ],
                [ 5, 6, 7, 8, 9 ],
                [ null, 'A', 'B', 'C', null ],
                [ null, null, 'D', null, null ],
            ];

            $this->position = [2, 0];

            $result = $this->decode($this->input_string);
        } else {
            $this->keypad = [
                [ 1, 2, 3 ],
                [ 4, 5, 6 ],
                [ 7, 8, 9 ]
            ];

            $this->position = [1, 1];

            $result = $this->decode($this->input_string);
        }

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

        if (isset($line) && (rtrim($line) != "") && (rtrim($line) != "\n")) {
//            print $line . "\n";

            $matches = str_split($line, 1);

            foreach ($matches as $m) {

                switch ($m) {
                    case 'U':
                        if (isset($this->keypad[$x-1][$y])) {
                            $x--;
                        }
                        break;
                    case 'D':
                        if (isset($this->keypad[$x+1][$y])) {
                            $x++;
                        }
                        break;
                    case 'L':
                        if (isset($this->keypad[$x][$y-1])) {
                            $y--;
                        }
                        break;
                    case 'R':
                        if (isset($this->keypad[$x][$y+1])) {
                            $y++;
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