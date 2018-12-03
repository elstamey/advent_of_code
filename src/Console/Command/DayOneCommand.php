<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class DayOneCommand extends Command
{
    private $inputString = '';


    protected function configure()
    {
        $this
            ->setName('day1')
            ->setDescription('Chronal Calibration')
            ->addArgument('inputFile', InputArgument::OPTIONAL, 'newFile', 'day1.txt')
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->inputString = file_get_contents($input->getArgument('inputFile'));


        if (isset($this->inputString) && $input->getOption('part2')) {

            list($frequency, $frequencies, $errors) = $this->getFirstDuplicateFrequency( $this->inputString );
            $output->writeln('<fg=green>result part 2 = ' . $frequency . "\n");
            return;

        } elseif (isset($this->inputString)) {

            list($result, $errors) = $this->getFrequency($this->inputString);
            $output->writeln('<fg=green>result part 1 = ' . $result . '</>');
            $output->writeln('<error>' . $errors . '</error>\n ');
            return;
        }

        $output->writeln('<error>Could not execute</error>');
    }

    /**
     *  Method to get the frequency by adding all of the digits to 0
     *
     * @param $inputString
     *
     * @return array
     */
    public function getFrequency($inputString)
    {
        $frequency = 0;
        $errors = "";

        $digits = $this->splitInputByLinesToArray($inputString);
        $count = count($digits) - 1;
        for ($i=0; $i < $count; $i++) {
            if ($digits[$i] !== null) {
                print($digits[$i] . "\n");
                $frequency += $digits[$i];
            } else {
                $errors .= 'NOT INT on ' . ($i + 1) . ' of ' . $count . "\n";
            }
        }

        return [$frequency, $errors];
    }

    private function splitInputByLinesToArray($inputString)
    {
        return array_map('intval', preg_split("/[\n]/", $inputString));
    }

    /**
     * method to get the frequency by adding all of the digits to 0 and continuing
     * to loop over them until the total frequency is reached twice
     *
     * @param $inputString
     *
     * @return
     */
    public function getFirstDuplicateFrequency($inputString)
    {
        $frequencies = [0];
        $frequency = 0;
        $errors = '';

        $digits = $this->splitInputByLinesToArray($inputString);
        $count = count($digits) - 1;
        $i = 0;
        $loopCount = 0;


        while (!$this->checkDuplicateFrequencies($frequencies)) {
            if ($digits[$i] !== null) {
                $frequency += $digits[$i];
                $frequencies[] = $frequency;
                print($frequency . "  \n");
            } else {
                $errors .= 'NOT INT on ' . ($i + 1) . ' of ' . $count . "\n";
            }

            if (($i+1) === $count) {
                $i=0;
            } else {
                $i++;
            }

            print ($frequency . " " . $i . ' ' . $loopCount . "\n");
            $loopCount++;
        }

        return [$frequency, $frequencies, $errors];
    }

    private function checkDuplicateFrequencies($frequencies)
    {
        return in_array(2, array_count_values($frequencies),true);
    }

}