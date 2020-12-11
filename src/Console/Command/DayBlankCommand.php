<?php
/**
 * Created by PhpStorm.
 * User: elstamey
 * Date: 12/7/15
 * Time: 7:18 PM
 */

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayBlankCommand extends Command
{
    /**
     * @var string
     */
    public string $inputString;

    protected function configure() : void
    {
        $this
            ->setName('dayblank')
            ->setDescription('The Ideal Stocking Stuffer')
            ->addArgument('inputFile', InputArgument::OPTIONAL, 'newFile', 'dayblank.txt')
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            );
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $file = $input->getArgument('inputFile');
        $result = '';
        if (is_string($file) && !empty($file)) {
            $this->inputString = file_get_contents($file);

            if ($input->getOption('part2')) {
                foreach (preg_split("/\n/", $this->inputString) as $line) {
                    if ($line != "") {
                    }
                }
            } else {
                foreach (preg_split("/\n/", $this->inputString) as $line) {
                    if ($line != "") {
                    }
                }
            }

        }

        $output->writeln("result = " . $result);
        return Command::SUCCESS;
    }

}