<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayTwoCommand extends Command
{
    /**
     * @var string
     */
    private string $inputString = '';


    /**
     *
     */
    protected function configure() : void
    {
        $this
            ->setName('day2')
            ->setDescription('Day 2: Password Philosophy')
            ->addArgument('inputFile', InputArgument::OPTIONAL, 'newFile', 'day2.txt')
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
     *
     * @psalm-return 0|1
     */
    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $file = $input->getArgument('inputFile');
        if (is_string($file) )
            $this->inputString = file_get_contents($file);

        if ( is_string($this->inputString) && $input->getOption('part2')) {

            $inputArray = preg_split('/\n/', $this->inputString);

            $result = $this->processPasswordsWithTobogganPolicies($inputArray);

            $output->writeln('result = ' . $result);
            return Command::SUCCESS;;

        } elseif (isset($this->inputString)) {

            $inputArray = preg_split('/\n/', $this->inputString);

            $result = $this->processPasswordsWithPolicies($inputArray);

            $output->writeln('result = ' . $result);
            return Command::SUCCESS;

        }

        $output->writeln('<error>Could not execute</error>');
        return Command::FAILURE;
    }

    /**
     * @param string $input
     *
     * @return string[]|null
     *
     */
    public function getRange(string $input) : ?array
    {
        return preg_split("/[\-]/", $input);
    }

    /**
     * @param string $input
     *
     * @return int[]
     *
     * @psalm-return array{0: int, 1: int}
     */
    public function getPositions(string $input) : array
    {
        $positions = preg_split("/[\-]/", $input);
        return [intval($positions[0]), intval($positions[1])];
    }

    /**
     * @param string $input
     *
     * @return string
     */
    public function getLetter(string $input) : string
    {
        $letter = preg_split("/\:/", $input);
        return $letter[0];
    }

    /**
     * @param string $letter
     * @param string $password
     *
     * @return int
     */
    public function countRepeatedLetters(string $letter, string $password)
    {
        return substr_count($password, $letter);
    }

    /**
     * @param string $line
     *
     * @return bool
     */
    public function isPasswordValid(string $line) : bool
    {
        $pieces = preg_split("/\s/", $line);

        if (count($pieces) !== 3) return false;

        $range = $this->getRange($pieces[0]);
        $letter = $this->getLetter($pieces[1]);
        $stringCount = $this->countRepeatedLetters($letter, $pieces[2]);

        return (is_array($range) && (count($range) === 2)) ? in_array($stringCount, range($range[0], $range[1])) : false;
    }

    /**
     * @param string[] $inputArray
     *
     * @return int
     */
    public function processPasswordsWithPolicies(array $inputArray) : int
    {
        $validPasswords = array_filter($inputArray, function (string $v, int $k) { return $this->isPasswordValid($v); }, ARRAY_FILTER_USE_BOTH);

        return count($validPasswords);
    }

    /**
     * @param string[] $inputArray
     *
     * @return int
     */
    public function processPasswordsWithTobogganPolicies(array $inputArray)
    {
        $validPasswords = array_filter($inputArray, function (string $v, int $k) { return $this->isPasswordOfficialTobogganCorpValid($v); }, ARRAY_FILTER_USE_BOTH);

        return count($validPasswords);
    }

    /**
     * @param string $line
     *
     * @return bool
     */
    public function isPasswordOfficialTobogganCorpValid(string $line) : bool
    {
        $pieces = preg_split("/\s/", $line);

        if (count($pieces) !== 3) return false;

        $positions = $this->getPositions($pieces[0]);
        $letter = $this->getLetter($pieces[1]);
        $password = $pieces[2];

        return $this->isLetterAtOnlyOneOfPositionsInPassword($letter, $positions, $password);
    }

    /**
     * @param string $letter
     * @param int[]  $positions
     * @param string $password
     *
     * @return bool
     */
    public function isLetterAtOnlyOneOfPositionsInPassword(string $letter, array $positions, string $password) : bool
    {
        $password = str_split($password);
        $pos1 = $positions[0] - 1;
        $pos2 = $positions[1] - 1;

        return ($password[$pos1] == $letter) xor ($password[$pos2] == $letter);
    }
}