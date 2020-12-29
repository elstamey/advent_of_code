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
    public int $total = 0;


    protected function configure() : void
    {
        $this
            ->setName('day7')
            ->setDescription('Day 7: Handy Haversacks')
            ->addArgument('inputFile', InputArgument::OPTIONAL, 'newFile', 'day7.txt')
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $file = $input->getArgument('inputFile') ?: '';
        $inputString = file_get_contents($file);

        if ($inputString ===false) {
            $output->writeln('<error>Could not execute</error>');
            return Command::FAILURE;
        }

        if ($input->getOption('part2')) {
            $rules = $this->buildRuleset($inputString);

            $result = $rules->countBagsInside('shiny gold');
        } else {
            $rules = $this->buildRuleset($inputString);

            $allBags = $rules->findBagsContaining('shiny gold');
            $result = count($allBags) - 1;
        }

        $output->writeln("result = " . $result);
        return Command::SUCCESS;

    }

    public function buildRuleset(string $ruleStrings) : Rules
    {
        $ruleStringsArray = preg_split('/\.\n/', $ruleStrings);
        $rules = new Rules;

        foreach ($ruleStringsArray as $rule) {
            $rules->createFromString($rule);
        }

        return $rules;
    }

}