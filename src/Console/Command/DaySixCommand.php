<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DaySixCommand extends Command
{

    var $commonChars = [];

    protected function configure()
    {
        $this
            ->setName('day6')
            ->setDescription('Day 6: Signals and Noise')
            ->addArgument('inputFile', null, 'newFile', 'day6.txt')
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input_string = file_get_contents($input->getArgument('inputFile'));

        if ($input->getOption('part2')) {
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                    $this->buildCommonChars($line);
                }
            }

            $result = $this->reallyDecodeMessage($this->commonChars);
        } else {
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                    $this->buildCommonChars($line);
                }
            }

            $result = $this->decodeMessage($this->commonChars);
        }
        $output->writeln("result = " . $result);
    }

    private function buildCommonChars($line)
    {
        $chars = str_split($line, 1);

        foreach ($chars as $key =>$char) {
            $this->commonChars[$key] = $this->commonChars[$key] . $char;
        }
    }

    private function decodeMessage($commonChars)
    {
        $message = '';

        foreach ($commonChars as $item) {
            $letters = str_split($item, 1);
            $countedLetters = array_count_values($letters);
            array_multisort(array_values($countedLetters), SORT_DESC, array_keys($countedLetters), SORT_ASC, $countedLetters);
            var_dump($countedLetters);
            $letter = array_slice($countedLetters, 0, 1);

            var_dump($letter);
            $message .= array_keys($letter)[0];
        }

        return $message;
    }


    private function reallyDecodeMessage($commonChars)
    {
        $message = '';

        foreach ($commonChars as $item) {
            $letters = str_split($item, 1);
            $countedLetters = array_count_values($letters);
            array_multisort(array_values($countedLetters), SORT_ASC, array_keys($countedLetters), SORT_ASC, $countedLetters);
            var_dump($countedLetters);
            $letter = array_slice($countedLetters, 0, 1);

            var_dump($letter);
            $message .= array_keys($letter)[0];
        }

        return $message;
    }
}