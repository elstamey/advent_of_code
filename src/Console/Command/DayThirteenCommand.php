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
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                }
            }
        }
        $result = '';
        $output->writeln("result = " . $result);
    }

    public function calculate($x, $y)
    {
        return (($x*$x) + (2*$x*$y) + $y + ($y*$y));
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
}