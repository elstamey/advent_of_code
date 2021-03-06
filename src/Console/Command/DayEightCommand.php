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

class DayEightCommand extends Command
{
    /**
     * @var string
     */
    var $input_string = '';

    private $rectangle = [];


    protected function configure()
    {
        $this
            ->setName('day8')
            ->setDescription('The Ideal Stocking Stuffer')
            ->addArgument('inputFile', null, 'newFile', 'day8.txt')
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
                }
            }
        } else {
            $replacePositions = [];

            $this->inputArray = preg_split('/\n/', $this->inputString);

            $computer = new BootCodeComputer();

            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                    $this->handleCommand($line);
                }
            }
        }
        $result = $this->countLights();
        $output->writeln("result = " . $result);
    }

}