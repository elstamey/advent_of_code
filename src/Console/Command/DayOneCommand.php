<?php

namespace Acme\Console\Command;

use Acme\Console\Models\Dial;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class DayOneCommand extends Command
{
    /**
     * @var string
     */
    private string $inputString = '';


    /**
     *
     */
    protected function configure() : void
    {
        $this
            ->setName('day1')
            ->setDescription('Day 1: Secret Entrance')
            ->addArgument('inputFile', InputArgument::OPTIONAL, 'newFile', 'input-day1.txt')
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            );
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $file = $input->getArgument('inputFile');
        if (is_string($file) )
            $this->inputString = file_get_contents($file);

        if ($input->getOption('part2')) {

            $result = $this->findProductOfThreeSumTwentyTwenty( $this->inputString );
            $output->writeln('<fg=green>result part 2 = ' . $result . "\n");
            return Command::SUCCESS;

        } else {

            $result = $this->findDialPointerPosition($this->inputString, 0, 99);
            $output->writeln('<fg=green>result part 1 = ' . $result . '</>');
            return Command::SUCCESS;
        }
    }


    /**
     * @param string $inputString
     *
     * @return string[]
     */
    private function splitInputByLinesToArray(string $inputString) : array
    {
        return preg_split("/[\n]/", $inputString);
    }

    /**
     *  Method to get the position of the arrow on the dial face
     *
     */
    private function findDialPointerPosition(string $inputString, int $lowestDialNumber=0, int $highestDialNumber=99): int
    {
        $myDial = new Dial($lowestDialNumber, $highestDialNumber);
        $myDial->setPointerAtFaceValue(50);

        $directions = $this->splitInputByLinesToArray($inputString);

        foreach ($directions as $direction) {
            if ($direction !== null) {
                $myDial->movePointer($direction);
            }
        }

        return $myDial->getDialPassword();
    }

    /**
     * @param string $inputString
     *
     * @return int
     */
    private function findProductOfThreeSumTwentyTwenty($inputString)
    {
        $digits = $this->splitInputByLinesToArray($inputString);
        $count = count($digits) - 1;
        for ($i=0; $i < $count; $i++) {
            for ($j=0; ($i!=$j) && $j < $count; $j++) {
                $numberNeeded = 2020 - $digits[$i] - $digits[$j];
                $digits2 = array_filter($digits, function ($k) use ($i, $j) { return (($k !== $i) && ($k !== $j)); }, ARRAY_FILTER_USE_KEY);
                $key = array_search($numberNeeded, $digits2);
                if ($key && ($digits[$i] != 0) && ($digits[$j] != 0) && ($digits2[$key] != 0)) {
                    return ($digits[$i] * $digits[$j] * $digits2[$key]);
                }
            }
        }

        return 50;
    }

}