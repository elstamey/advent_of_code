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
        if (is_string($file)) {
            $inputString = file_get_contents($file);
        } else {
            $output->writeln('<error>Could not execute</error>');
            return Command::FAILURE;
        }

        if ($inputString === false) {
            $output->writeln('<error>Could not execute</error>');
            return Command::FAILURE;
        }

        $inputArray = preg_split('/\n/', $inputString);
        if (!is_array($inputArray)) {
            $output->writeln('<error>Could not execute</error>');
            return Command::FAILURE;
        }

        if ($input->getOption('part2')) {

            /** @var bool $hasVisitedPrevious */
            $hasVisitedPrevious = false;
            $hasBeenVisited = false;

            $replacePositions = $this->getReplacePositions($inputArray);
            $replacedInputs = $this->replaceInputs($inputArray, $replacePositions);

            foreach ($replacedInputs as $newInputArray) {
                $instructionPosition = 0;
                $computer = new BootCodeComputer();

                while (!$hasVisitedPrevious && !$hasBeenVisited && ($result === 0)) {
                    $instructions = preg_split('/\s/', $newInputArray[$instructionPosition]);
                    $code = $instructions[0];
                    $amount = (int)$instructions[1];

                    if ($computer->hasVisitedPrevious($instructionPosition)) {
                        $result = $computer->getAccumulator();
                    }

                    $this->handleInstructions($computer, $code, $amount);
                    $instructionPosition = $computer->getPosition();
                    $instructions = preg_split('/\s/', $newInputArray[$instructionPosition]);
                    $code = $instructions[0];
                    $amount = (int)$instructions[1];
                    $hasBeenVisited = $computer->hasBeenVisited($code, $amount);
                    $hasVisitedPrevious = $computer->hasVisitedPrevious($instructionPosition);

                }
            }

        } else {

            $computer = new BootCodeComputer();

            $instructionPosition = 0;
            $hasBeenVisited = false;

            while (!$hasBeenVisited) {
                $instructions = preg_split('/\s/', $inputArray[$instructionPosition]);
                $code = $instructions[0];
                $amount = intval($instructions[1]);

                if (!$computer->hasBeenVisited($code, $amount)) {
                    $this->handleInstructions($computer, $code, $amount);
                }

                $instructionPosition = $computer->getPosition();
                $instructions = preg_split('/\s/', $inputArray[$instructionPosition]);
                $code = $instructions[0];
                $amount = intval($instructions[1]);
                $hasBeenVisited = $computer->hasBeenVisited($code, $amount);
                $result = $computer->getAccumulator();
            }

        }

        if (is_int($result) && ($result !== 0)) {
            $output->writeln('result = ' . $result);
            return Command::SUCCESS;
        }

        $output->writeln('<error>Could not execute</error>');
        return Command::FAILURE;

    }

    /**
     * @param BootCodeComputer $computer
     * @param string           $code
     * @param int              $amount
     */
    protected function handleInstructions(BootCodeComputer $computer, string $code, int $amount): void
    {
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

    /**
     * @param string[] $inputArray
     *
     * @return int[]
     */
    public function getReplacePositions(array $inputArray) : array
    {
        $replacePositions = [];

        foreach ($inputArray as $k=>$input) {
            $instructions = preg_split("/\s/", $input);
            $code = $instructions[0];
            if (($code === 'jmp') || ($code === 'nop')) {
                $replacePositions[] = $k;
            }
        }
        return $replacePositions;
    }

    /**
     * @param string[] $inputArray
     * @param int[] $replacePositions
     *
     * @return array<int, array<string>>
     */
    public function replaceInputs(array $inputArray, array $replacePositions) : array
    {
        $returnArray = [];

        foreach ($replacePositions as $pos) {
            $newArray = $inputArray;
            $newArray[$pos] = $this->replaceJumpOrNop($newArray[$pos]);
            $returnArray[] = $newArray;
        }

        return $returnArray;
    }

    public function replaceJumpOrNop(string $instruction) : string
    {
        if (preg_match("/nop/", $instruction) === 1) {
            return preg_replace("/nop/", "jmp", $instruction);
        } elseif (preg_match("/jmp/", $instruction) === 1) {
            return preg_replace("/jmp/", "nop", $instruction);
        }
        return $instruction;
    }
}