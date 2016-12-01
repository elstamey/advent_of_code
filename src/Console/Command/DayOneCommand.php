<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayOneCommand extends Command
{

    var $input_string = '';

    protected function configure()
    {
        $this
            ->setName('day1')
            ->setDescription('No Time for a Taxicab')
            ->addArgument('inputFile', null, 'newFile', 'day1.txt')
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input_string = file_get_contents($input->getArgument('inputFile'));

        if ($input->getOption('part2')) {
            $newLocation = [0,0];
            if (isset($this->input_string)) {
                $newLocation = $this->calculateNewLocation( $this->input_string );
            }
            $result = $newLocation;
        } else {
            if (isset($this->input_string)) {
                $newLocation = $this->calculateNewLocation( $this->input_string );
            }
            $result = $newLocation;
        }

        $output->writeln("result = " . $result);
    }

    private function calculateNewLocation($input_string)
    {
        $newLocation = 0;
        foreach (preg_split("/, /", $this->input_string) as $dir) {
            if (isset($dir) && ($dir != "")) {
                $direction = substr($dir, 0 , 1);
                $distance = substr($dir, 1);

                switch ($direction) {
                    case 'L':
                        $newLocation -= $distance;
                    case 'R':
                        $newLocation += $distance;
                }

//                $newLocation .= $dir."\n";
            }
        }

        return $newLocation;
    }


}