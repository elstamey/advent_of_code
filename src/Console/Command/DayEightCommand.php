<?php
/**
 * Created by PhpStorm.
 * User: elstamey
 * Date: 12/7/15
 * Time: 7:18 PM
 */

namespace Acme\Console\Command;

use Acme\Console\Models\BootCodeComputer;
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
    var string $inputString;

    /**
     * @var array|string[]
     */
    private array $inputArray;


    protected function configure() : void
    {
        $this
            ->setName('day8')
            ->setDescription('Day 8: Handheld Halting')
            ->addArgument('inputFile', null, 'newFile', 'day8.txt')
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

            $this->inputArray = preg_split('/\n/', $this->inputString);

            if (is_array($this->inputArray)) {
                foreach ($this->inputArray as $instruction) {

                }
            }



        } elseif (isset($this->inputString)) {

            $this->inputArray = preg_split('/\n/', $this->inputString);

            $computer = new BootCodeComputer();

            if (is_array($this->inputArray)) {
                $instructionPosition = 0;
                $hasBeenVisited = false;

                while (!$hasBeenVisited) {
                    $instructions = preg_split('/\s/', $this->inputArray[$instructionPosition]);
                    $code = $instructions[0];
                    $amount = intval($instructions[1]);

                    if (!$computer->hasBeenVisited($code, $amount)) {
                        switch ($code) {
                            case 'nop':
                                $computer->noOp();
                                $computer->recordVisit();
                                break;
                            case 'acc':
                                $computer->accumulate($amount);
                                $computer->makeJump(1);
                                $computer->recordVisit();
                                break;
                            case 'jmp':
                                $computer->makeJump($amount);
                                $computer->recordVisit();
                                break;
                            default:
                                break;
                        }
                    }

                    $instructionPosition = $computer->getPosition();
                    $instructions = preg_split('/\s/', $this->inputArray[$instructionPosition]);
                    $code = $instructions[0];
                    $amount = intval($instructions[1]);
                    $hasBeenVisited = $computer->hasBeenVisited($code, $amount);
                    $result = $computer->getAccumulator();
                }

            }

        }

        if (is_int($result) && ($result!==0)) {
            $output->writeln('result = ' . $result);
            return Command::SUCCESS;
        }

        $output->writeln('<error>Could not execute</error>');
        return Command::FAILURE;
    }

}