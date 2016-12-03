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

        foreach (preg_split("/\n/", $this->input_string) as $line) {
            if (isset($line) && ($line != "")) {

            }
        }

        $result = '';
        $output->writeln("result = " . $result);
    }

}