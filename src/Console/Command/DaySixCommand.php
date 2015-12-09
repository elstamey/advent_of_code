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
        ini_set('memory_limit','130M');
        ini_set('max_execution_time', 300);

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
//        $this->map = array_fill(0, 999, array_fill(0, 999, 0));

        if ($input->getOption('part2')) {
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                }
            }
        } else {
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                    $instructions = preg_split("/ /", $line);
                    if ($instructions[0] == "toggle") {
                        $this->toggle($instructions);
                    } else {
                        print($line."\n");
                    }
                }
            }
        }
        $result = $this->returnOnLights($this->map);

        die(var_dump($result));
        $output->writeln("result = " . $result);
    }

    private function toggle( $instructions )
    {
        $from = preg_split("/,/", $instructions[1]);
        $to = preg_split("/,/", $instructions[3]);
        for ($i=$from[0]; $i < $to[0]; $i++) {
            for ($j=$from[1]; $j < $to[1]; $j++) {
               if ((!isset($this->map[$i][$j])) or ($this->map[$i][$j] == 0)) {
                   $this->map[$i][$j] = 1;
               } elseif ($this->map[$i][$j] == 1) {
                   $this->map[$i][$j] = 0;
               } else {
                   throw new InvalidArgumentException('invalid coordinate');
               }
            }
        }
//        die(var_dump($from[0]." ".$to[0]));
    }

    private function returnOnLights($map)
    {
        $newMap = [];
        for ($i=0; $i <= 999; $i++) {
            for ($j=0; $j <= 999; $j++) {
                if (isset($this->map[$i][$j]) && $map[$i][$j] == 1) {
                    array_push($newMap, 1);
                }
            }
        }
        return $newMap;
    }

}