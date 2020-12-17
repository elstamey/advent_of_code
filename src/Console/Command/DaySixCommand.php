<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DaySixCommand extends Command
{

    private string $inputString;
    /**
     * @var array|false|string[]
     */
    private $inputArray;

    protected function configure() : void
    {
        $this
            ->setName('day6')
            ->setDescription('Day 6: Custom Customs')
            ->addArgument('inputFile', null, 'newFile', 'day6.txt')
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $result = 0;
        $file = $input->getArgument('inputFile');
        if (is_string($file) )
            $this->inputString = file_get_contents($file);

        if (isset($this->inputString) && is_string($this->inputString) && $input->getOption('part2')) {

            $this->inputArray = preg_split('/\n\n/', $this->inputString);

            foreach ($this->inputArray as $group) {
                $groupMembersAnswers = preg_split('/\r|\n|\s/', $group);
                $groupMembersLetters = array_map('str_split', $groupMembersAnswers);
                $memCount = count($groupMembersLetters);
                if ($memCount === 0) {
                    $numberGroupYeses = 0;
                } elseif ($memCount === 1) {
                    $numberGroupYeses = count($groupMembersLetters[0]);
                } else {
                    $intersect = $groupMembersLetters[0];

                    for ($i=1; $i<$memCount; $i++) {
                        if (!empty($groupMembersLetters[$i]))
                            $intersect = array_intersect($intersect, $groupMembersLetters[$i]);
                    }
                    $numberGroupYeses = count($intersect);
                }

                $result += $numberGroupYeses;
            }


        } elseif (isset($this->inputString)) {

            $this->inputArray = preg_split('/\n\n/', $this->inputString);

            foreach ($this->inputArray as $group) {
                $group = preg_replace('/\r|\n|\s/', '', $group);
                $groupYes = str_split($group, 1);
                $numberGroupYeses = count(array_unique($groupYes));
                $result += $numberGroupYeses;
            }
        }

        if (is_int($result) && ($result>0)) {
            $output->writeln('result = ' . $result);
            return Command::SUCCESS;
        }

        $output->writeln('<error>Could not execute</error>');
        return Command::FAILURE;
    }
}