<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayTwoCommand extends Command
{
    private $inputString = '';

    /**
     * @var int[]
     */
    private $inputArray;

    protected function configure()
    {
        $this
            ->setName('day2')
            ->setDescription('Day 2: 1202 Program Alarm')
            ->addArgument('inputFile', null, 'newFile', 'day2.txt')
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

            $output->writeln('result = ' . $this->getCorrectBoxId());
            return;

        } elseif (isset($this->inputString)) {

            $this->inputArray = preg_split('/\,/', $this->inputString);
            $this->inputArray = array_map('intval', $this->inputArray);

            $this->initializeInputArray();

            var_dump($this->inputArray);

            $count = count($this->inputArray);

            for ($i=0; (($i < $count) && ($this->inputArray[$i] !== 99)); $i=$i+4) {

                print ($i . "\n");
                $this->printOpCodes($i);
                list($opCode, $valueOnePosition, $valueTwoPosition, $resultPosition) = $this->readOpCodes($i);

                $this->handleOpCodes($opCode, $valueOnePosition,  $valueTwoPosition, $resultPosition);
                print ($this->inputArray[$resultPosition] . "\n");

                $this->printOpCodes($resultPosition-3);
                print("-----\n");
            }
            $output->writeln('result = ' . $this->inputArray[0]);
            return;

        }

        $output->writeln('<error>Could not execute</error>');
    }

    /**
     * @param int $startPosition
     * @return int[]
     */
    public function readOpCodes($startPosition)
    {
        return [
            $this->inputArray[$startPosition],
            $this->inputArray[$startPosition +1],
            $this->inputArray[$startPosition +2],
            $this->inputArray[$startPosition +3]
        ];
    }

    /**
     *
     * @param int $opCode
     * @param int $valueOnePosition
     * @param int $valueTwoPosition
     * @param int $resultPosition
     * @return void
     */
    private function handleOpCodes($opCode, $valueOnePosition, $valueTwoPosition, $resultPosition)
    {
        switch ($opCode) {
            case 1:
                print ("add\n");
                $this->inputArray[$resultPosition] = $this->inputArray[$valueOnePosition] + $this->inputArray[$valueTwoPosition];
                break;
            case 2:
                print("multiply\n");
                $this->inputArray[$resultPosition] = $this->inputArray[$valueOnePosition] * $this->inputArray[$valueTwoPosition];
                break;
        }
    }

    private function initializeInputArray()
    {
        $this->inputArray[1] = 12;
        $this->inputArray[2] = 2;

    }

    private function printOpCodes($i)
    {
        if (($i+3) < count($this->inputArray)) {
            print ( $this->inputArray[$i] . " ");
            print ( $this->inputArray[$i+1] . " ");
            print ( $this->inputArray[$i+2] . " ");
            print ( $this->inputArray[$i+3] . " \n");
        }
    }
}