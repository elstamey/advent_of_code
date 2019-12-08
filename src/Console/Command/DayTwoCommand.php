<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Acme\Console\Models\IntCodeComputer;

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

            $this->inputArray = preg_split('/\,/', $this->inputString);
            $this->inputArray = array_map('intval', $this->inputArray);



            foreach (range(0, 99) as $noun) {
                foreach (range(0,99) as $verb) {
                    $computer = new IntCodeComputer($this->inputArray, 3);
                    $computer->initializeInputArray($noun, $verb);
                    $result = $computer->compute();

                    if ($result === 19690720) {
                        print("Desired Result achieved!");
                        $result = 100 * $noun + $verb;

                        $output->writeln('result = ' . $result);
                        return;
                    }
                }
            }



        } elseif (isset($this->inputString)) {

            $this->inputArray = preg_split('/\,/', $this->inputString);
            $this->inputArray = array_map('intval', $this->inputArray);

            $computer = new IntCodeComputer($this->inputArray, 3);
            $computer->initializeInputArray(12, 2);
            $result = $computer->compute();

            $output->writeln('result = ' . $result);
            return;

        }

        $output->writeln('<error>Could not execute</error>');
    }

}