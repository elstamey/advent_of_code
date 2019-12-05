<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayFourCommand extends Command
{

    /**
     * @var int
     */
    private $minVal = 240298;
    /**
     * @var int
     */
    private $maxVal = 784956;

    /**
     *
     */
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

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = 0;

        if ($input->getOption('part2')) {

            for ($i = $this->minVal; $i <= $this->maxVal; $i++) {
                $result += (int) $this->isValidPassword($i, true);
            }

        } else {

            for ($i = $this->minVal; $i <= $this->maxVal; $i++) {
                $result += (int) $this->isValidPassword($i);
            }

        }

        $output->writeln("result = " . $result);
    }

    /**
     * @param int $password
     * @param bool $part2
     * @return bool
     */
    public function isValidPassword($password, $part2=false)
    {
        return (
            $this->isSixDigits($password) &&
            $this->isWithinRange($password) &&
            $this->digitsDontDecrease($password) &&
            $this->containsDoubleDigits($password, $part2)
        );
    }

    /**
     * @param int $password
     * @return bool
     */
    public function isSixDigits($password)
    {
        $length = strlen((string) $password);

        return ($length === 6);
    }

    /**
     * @param int $password
     * @return bool
     */
    public function isWithinRange($password)
    {
        return ( ($this->minVal <= $password) && ($this->maxVal >= $password) );
    }


    /**
     * @param int $password
     * @return bool
     */
    public function digitsDontDecrease($password)
    {
        $digits = str_split( (string) $password, 1);

        for ($i=0; $i < 5; $i++) {
            if ($digits[$i] > $digits[$i+1]) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param int $password
     * @param bool $part2
     * @return bool
     */
    public function containsDoubleDigits($password, $part2=false)
    {
        $digits = str_split( (string) $password, 1);

        for ($i=0; $i < 5; $i++) {
            if ($digits[$i] === $digits[$i+1]) {

                if (!$part2) {
                    return true;
                } elseif ($part2) {
                    $doubleDigits = substr_count((string)$password, $digits[$i], 0, 6);
                    if ($doubleDigits === 2) {
                        return true;
                    }

                }
            }
        }

        return false;
    }

}