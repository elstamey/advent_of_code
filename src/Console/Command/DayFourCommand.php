<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayFourCommand extends Command
{

    private $minVal = 240298;
    private $maxVal = 784956;

    protected function configure()
    {
        $this
            ->setName('day4')
            ->setDescription('Day 4: Secure Container')
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
            $result = 0;

            foreach (preg_split("/\n/", $this->inputString) as $line) {
                if (isset($line) && ($line != "")) {
                    $result += (int) $this->passwordDoesNotContainAnagrams($line);
                }
            }

        } else {
            $result = 0;

            for ($i = $this->minVal; $i <= $this->maxVal; $i++) {
                $result += (int) $this->isValidPassword($i);
            }

        }

        $output->writeln("result = " . $result);
    }


    public function isValidPassword($password)
    {
        return (
            $this->isSixDigits($password) &&
            $this->isWithinRange($password) &&
            $this->digitsDontDecrease($password) &&
            $this->containsDoubleDigits($password)
        );
    }

    public function isSixDigits($number)
    {
        $length = strlen((string) $number);

        return ($length === 6);
    }

    public function isWithinRange($number)
    {
        return ( ($this->minVal <= $number) && ($this->maxVal >= $number) );
    }


    public function digitsDontDecrease($number)
    {
        $digits = str_split( (string) $number, 1);

        for ($i=0; $i < 5; $i++) {
            if ($digits[$i] > $digits[$i+1]) {
                return false;
            }
        }

        return true;
    }

    public function containsDoubleDigits($number)
    {
        $digits = str_split( (string) $number, 1);

        for ($i=0; $i < 5; $i++) {
            if ($digits[$i] === $digits[$i+1]) {
                return true;
            }
        }

        return false;
    }
}