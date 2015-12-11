<?php
/**
 * Created by PhpStorm.
 * User: elstamey
 * Date: 12/7/15
 * Time: 7:18 PM
 */

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DaySixCommand extends Command
{
    /**
     * @var string
     */
    var $input_string = '';

    /**
     * @var array
     */
    var $map = [];

    protected function configure()
    {
        ini_set('memory_limit','5000M');

        $this
            ->setName('day6')
            ->setDescription('The Ideal Stocking Stuffer')
            ->addArgument('inputFile', null, 'newFile', 'day6.txt')
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
        $this->map = array_fill(0, 999, array_fill(0, 999, 0));

        if ($input->getOption('part2')) {
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                    $instructions = preg_split("/ /", $line);
                    if ($instructions[0] == "toggle") {
                        $this->toggle2($instructions);
                    } elseif ($instructions[0] == "turn") {
                        $this->turn2($instructions);
                    } else {
                        print($line."\n");
                    }
                }
            }
            $result = $this->returnTotalBrightness($this->map);

        } else {
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                    $instructions = preg_split("/ /", $line);
                    if ($instructions[0] == "toggle") {
                        $this->toggle($instructions);
                    } elseif ($instructions[0] == "turn") {
                        $this->turn($instructions);
                    } else {
                        print($line."\n");
                    }
                }
            }
            $result = $this->returnNumberOfOnLights($this->map);
        }

        $output->writeln("result = " . $result);
    }

    private function toggle( $instructions )
    {
        $from = preg_split("/,/", $instructions[1]);
        $to = preg_split("/,/", $instructions[3]);

        $this->buildMap($from, $to);
    }

    private function toggle2( $instructions )
    {
        $from = preg_split("/,/", $instructions[1]);
        $to = preg_split("/,/", $instructions[3]);

        $this->buildMap2($from, $to, 2);
    }

    private function turn( $instructions )
    {
        $from = preg_split("/,/", $instructions[2]);
        $to = preg_split("/,/", $instructions[4]);

        $this->buildMap($from, $to, $instructions[1]);
    }

    private function turn2( $instructions )
    {
        $from = preg_split("/,/", $instructions[2]);
        $to = preg_split("/,/", $instructions[4]);

        if ($instructions[1] == 'on') {
            $val = 1;
        } elseif ($instructions[1] == 'off') {
            $val = -1;
        }
        $this->buildMap2($from, $to, $val);
    }

    private function buildMap($from, $to, $val=null)
    {
        for ($i=$from[0]; $i <= $to[0]; $i++) {
            for ($j=$from[1]; $j <= $to[1]; $j++) {
                if (isset($val)) {
                    $this->map[$i][$j] = $val;
                } elseif ((!isset($this->map[$i][$j])) or ($this->map[$i][$j] == 0)) {
                    $this->map[$i][$j] = 1;
                } elseif ($this->map[$i][$j] == 1) {
                    $this->map[$i][$j] = 0;
                } else {
                    throw new InvalidArgumentException('invalid coordinate');
                }
            }
        }
    }

    private function buildMap2($from, $to, $val)
    {
        for ($i=$from[0]; $i <= $to[0]; $i++) {
            for ($j=$from[1]; $j <= $to[1]; $j++) {
                if (isset($this->map[$i][$j])) {
                    $this->map[$i][$j] += $val;
                } else {
                    $this->map[$i][$j] = $val;
                }

                $this->map[$i][$j] = ($this->map[$i][$j] < 0 ) ? 0 : $this->map[$i][$j] ;
            }
        }
    }

    private function returnNumberOfOnLights($map)
    {
        $newMap = [];
        for ($i=0; $i <= 999; $i++) {
            for ($j=0; $j <= 999; $j++) {
                if (isset($map[$i][$j]) && $map[$i][$j] == 1) {
                    array_push($newMap, 1);
                }
            }
        }
        return count($newMap);
    }

    private function returnTotalBrightness($map)
    {
        $brightness = 0;
        for ($i=0; $i <= 999; $i++) {
            for ($j=0; $j <= 999; $j++) {
                if (isset($map[$i][$j]) && ($map[$i][$j] >= 0)) {
                   $brightness += $map[$i][$j];
                }
            }
        }
        return $brightness;
    }
}