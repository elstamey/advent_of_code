<?php

namespace Acme\Console\Command;

use Acme\Console\Models\Rules;
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
            $rules = $this->buildRuleset($this->inputString);

            $allBags = $rules->findBagsContaining('shiny gold');
            $result = count($allBags) - 1;
        }

        if ($result !== 0) {
            $output->writeln("result = " . $result);
            return Command::SUCCESS;
        }

        $output->writeln('<error>Could not execute</error>');
        return Command::FAILURE;

    }

    public function buildRuleset(string $ruleStrings) : Rules
    {
        $ruleStrings = preg_split('/\.\n/', $ruleStrings);
        $rules = new Rules;

        foreach ($ruleStrings as $rule) {
            $rules->createFromString($rule);
        }

        return $rules;
    }

}