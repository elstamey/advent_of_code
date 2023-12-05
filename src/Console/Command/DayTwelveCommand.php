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

class DayTwelveCommand extends Command
{
    /**
     * @var int
     */
    private $a = 0;
    /**
     * @var
     */
    private $b = 0;
    /**
     * @var
     */
    private $c = 0;
    /**
     * @var
     */
    private $d = 0;

    private $key = 0;

    private $lines;

    protected function configure()
    {
        $this
            ->setName('day12')
            ->setDescription('The Ideal Stocking Stuffer')
            ->addArgument('inputFile', null, 'newFile', 'day12.txt')
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
            $this->c = 1;
            $this->lines = preg_split("/\n/", $this->input_string);
            for ($this->key=0; $this->key < count($this->lines); $this->key++) {
                if (isset($this->lines[$this->key]) && ($this->lines[$this->key] != "")) {
                    print "\n\n" . $this->lines[$this->key] . "\n";
                    var_dump($this->a, $this->b, $this->c, $this->d);
                    $this->handleCommand($this->lines[$this->key]);
                }
            }

            var_dump($this->a, $this->b, $this->c, $this->d);
        } else {
            $this->lines = preg_split("/\n/", $this->input_string);
            for ($this->key=0; $this->key < count($this->lines); $this->key++) {
                if (isset($this->lines[$this->key]) && ($this->lines[$this->key] != "")) {
                    print "\n\n" . $this->lines[$this->key] . "\n";
                    var_dump($this->a, $this->b, $this->c, $this->d);
                    $this->handleCommand($this->lines[$this->key]);
                }
            }

            var_dump($this->a, $this->b, $this->c, $this->d);
        }
        $result = $this->a;
        $output->writeln("result = " . $result);
    }

    private function handleCommand($line): void
    {
        $command = preg_split('/\s/', $line);

        switch ($command[0]) {
            case 'cpy':
//                print('CPY\n');
                $this->copyCommand($command[1], $command[2]);
                break;
            case 'inc':
                $this->increaseCommand($command[1]);
                break;
            case 'dec':
                $this->decreaseCommand($command[1]);
                break;
            case 'jnz':
                $this->jumpCommand($command[1], $command[2]);
                break;
        }
    }

    private function copyCommand($value, $reg1): void
    {
        if (isset($this->$value)) {
            $this->$reg1 = $this->$value;
        } else {
            $this->$reg1 = $value;
//            var_dump($this->$reg1, $value);
        }
//        die();
    }

    private function increaseCommand($reg1): void
    {
        $this->$reg1++;
//        var_dump($this->$reg1);
    }

    private function decreaseCommand($reg1): void
    {
        $this->$reg1--;
//        var_dump($this->$reg1);
    }

    private function jumpCommand($reg1, $jumpAmount): void
    {
        $value = (isset($this->$reg1)) ? $this->$reg1 : $reg1;

        if ($value > 0) {
            print "JUMP " . $reg1  . " value = " . $value . " jump: " . $jumpAmount . "\n";

            if (($this->key + $jumpAmount) >= 0) {
//                $newKey = $this->key + $jumpAmount;
//                $this->handleCommand($this->lines[$newKey]);
                $this->key += ($jumpAmount - 1);
//                var_dump($this->$reg1);
//                die();
            } else {
                print "NOT JUMPING\n";
            }
        } else {
            print "NOT JUMPING\n";
        }

    }

}