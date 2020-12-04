<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

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
            ->setDescription('Day 2: Password Philosophy')
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

            $this->inputArray = preg_split('/\n/', $this->inputString);

            $result = $this->processPasswordsWithTobogganPolicies($this->inputArray);

            $output->writeln('result = ' . $result);
            return Command::SUCCESS;;

        } elseif (isset($this->inputString)) {

            $this->inputArray = preg_split('/\n/', $this->inputString);

            $result = $this->processPasswordsWithPolicies($this->inputArray);

            $output->writeln('result = ' . $result);
            return Command::SUCCESS;

        }

        $output->writeln('<error>Could not execute</error>');
        return Command::FAILURE;

    }

    public function getRange($input)
    {
        return preg_split("/[\-]/", $input);
    }

    public function getPositions($input)
    {
        return preg_split("/[\-]/", $input);
    }

    public function getLetter(string $input)
    {
        $letter = preg_split("/\:/", $input);
        return $letter[0];
    }

    public function countRepeatedLetters(string $letter, string $password)
    {
        return substr_count($password, $letter);
    }

    public function isPasswordValid(string $line)
    {
        $pieces = preg_split("/\s/", $line);

        if (count($pieces) !== 3) return false;

        $range = $this->getRange($pieces[0]);
        $letter = $this->getLetter($pieces[1]);
        $stringCount = $this->countRepeatedLetters($letter, $pieces[2]);

        return in_array($stringCount, range($range[0], $range[1]));
    }

    public function processPasswordsWithPolicies(array $inputArray)
    {
        $validPasswords = array_filter($inputArray, function ($v, $k) { return $this->isPasswordValid($v); }, ARRAY_FILTER_USE_BOTH);

        return count($validPasswords);
    }

    public function processPasswordsWithTobogganPolicies(array $inputArray)
    {
        $validPasswords = array_filter($inputArray, function ($v, $k) { return $this->isPasswordOfficialTobogganCorpValid($v); }, ARRAY_FILTER_USE_BOTH);

        return count($validPasswords);
    }

    public function isPasswordOfficialTobogganCorpValid(string $line)
    {
        $pieces = preg_split("/\s/", $line);

        if (count($pieces) !== 3) return false;

        $positions = $this->getPositions($pieces[0]);
        $letter = $this->getLetter($pieces[1]);
        $password = $pieces[2];

        return $this->isLetterAtOnlyOneOfPositionsInPassword($letter, $positions, $password);
    }

    public function isLetterAtOnlyOneOfPositionsInPassword(string $letter, $positions, string $password)
    {
        $password = str_split($password);
        $pos1 = $positions[0] - 1;
        $pos2 = $positions[1] - 1;

        return ($password[$pos1] == $letter) xor ($password[$pos2] == $letter);
    }
}