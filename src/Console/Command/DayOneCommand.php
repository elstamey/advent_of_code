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
            $allRibbonNeeded = 0;
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                    $dimensions = preg_split( "/x/", $line );

                    $allRibbonNeeded += $this->calculateRibbonNeededForPackage( $dimensions );
                    $allRibbonNeeded += $this->calculateRibbonNeededForBow( $dimensions );
                }
            }
            $result = $allRibbonNeeded;
        } else {
            $allWrappingPaperNeeded = 0;
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                    $dimensions = preg_split( "/x/", $line );
//                    $allWrappingPaperNeeded += $this->calculateWrappingPaperNeeded( $dimensions );
                }
            }
            $result = $allWrappingPaperNeeded;
        }

        $output->writeln("result = " . $result);
    }




}