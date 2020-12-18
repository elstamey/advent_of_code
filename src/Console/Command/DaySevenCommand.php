<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DaySevenCommand extends Command
{
    /**
     * @var int
     */
    var $total = 0;
    /**
     * @var false|string
     */
    private string $inputString;


    protected function configure() : void
    {
        $this
            ->setName('day7')
            ->setDescription('Day 7: Handy Haversacks')
            ->addArgument('inputFile', null, 'newFile', 'day7.txt')
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $this->inputString = file_get_contents($input->getArgument('inputFile'));
        $result = 0;

        if ($input->getOption('part2')) {
            foreach (preg_split("/\n/", $this->inputString) as $line) {
                if (isset($line) && ($line != "")) {
//                    $this->total += intval($this->supportsSSL($line));
                }
            }
        } else {
            foreach (preg_split("/\n/", $this->inputString) as $line) {
                if (isset($line) && ($line != "")) {
//                    $this->total += intval($this->supportsTLS($line));
                }
            }
        }

        if ($result !== 0) {
            $output->writeln("result = " . $result);
            return Command::SUCCESS;
        }

        $output->writeln('<error>Could not execute</error>');
        return Command::FAILURE;

    }

    public function buildRuleset(string $rules) : array
    {
        $rules = preg_split('/\.\n/', $rules);
        $formattedRules = [];

        foreach ($rules as $rule) {
            $thisRule = preg_split('/ contain /', $rule);
            $thisRule[1] = preg_replace('/[0-9]\s/', '', $thisRule[1]);
            $thisRule[1] = preg_split('/\,\s/', $thisRule[1]);
            $formattedRules[$thisRule[0]] = $thisRule[1];
        }
var_dump($formattedRules);
        return $formattedRules;
    }

}