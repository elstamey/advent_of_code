<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayTwoCommand extends Command
{

    var $input_string = '';

    protected function configure()
    {
        $this
            ->setName('day2')
            ->setDescription('I was told there would be no math')
            ->addArgument('inputFile', null, 'newFile', 'day2.txt')
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
                    $allWrappingPaperNeeded += $this->calculateWrappingPaperNeeded( $dimensions );
                }
            }
            $result = $allWrappingPaperNeeded;
        }

        $output->writeln("result = " . $result);
    }

    private function calculateWrappingPaperNeeded( $dimensions )
    {
        $l = $dimensions[0];
        $w = $dimensions[1];
        $h = $dimensions[2];

        $extraWrapping = $this->getAreaOfSmallestSide($l, $w, $h);
        $wrappingPaperNeeded = (2 * $l * $w) + (2 * $w * $h) + (2 * $h * $l) + $extraWrapping;

        return $wrappingPaperNeeded;
    }

    private function getAreaOfSmallestSide( $l, $w, $h )
    {
        $side1 = $l * $w;
        $side2 = $w * $h;
        $side3 = $h * $l;

        return min($side1, $side2, $side3);
    }

    private function calculateRibbonNeededForPackage( $dimensions )
    {
        $sides = $this->getTwoSmallestSides($dimensions);
        $l = $sides[0];
        $w = $sides[1];

        return ($l + $l + $w + $w);
    }

    private function getTwoSmallestSides( $dimensions )
    {
        $l = $dimensions[0];
        $w = $dimensions[1];
        $h = $dimensions[2];

        $sides = [$l, $w, $h];

        sort($sides, SORT_NUMERIC);
        array_pop($sides);

        return $sides;
    }

    private function calculateRibbonNeededForBow( $dimensions )
    {
        $l = $dimensions[0];
        $w = $dimensions[1];
        $h = $dimensions[2];

        return ($l * $w * $h);
    }


}