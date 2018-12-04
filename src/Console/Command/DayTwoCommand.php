<?php

namespace Acme\Console\Command;

use Acme\InputHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayTwoCommand extends Command
{
    private $inputString = '';

    protected function configure()
    {
        $this
            ->setName('day2')
            ->setDescription('Day 2: Inventory Management System')
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

            $output->writeln('result = ' . $this->getCorrectBoxId());
            return;

        } elseif (isset($this->inputString)) {

            $output->writeln('result = ' . $this->getChecksum());
            return;

        }

        $output->writeln('<error>Could not execute</error>');
    }


    /**
     * The checksum = a * b where
     *   a = the number of boxIds that contain 2 of a letter
     *   b = the number of boxIds that contain 3 of a letter
     *
     * @param $inputString
     *
     * @return int
     */
    private function getChecksum()
    {
        list($twiceBoxIdCount, $thriceBoxIdCount) = $this->getTwiceAndThriceBoxIdCounts();

        return ($twiceBoxIdCount * $thriceBoxIdCount);
    }

    private function getTwiceAndThriceBoxIdCounts()
    {
        $twiceBoxIdCount = 0;
        $thriceBoxIdCount = 0;

        foreach ($this->getRows() as $row) {

            $chars = InputHelper::splitCharacters($row);

            $counts = array_count_values($chars);

            $twiceBoxIdCount += in_array(2, $counts, true) ? 1 : 0;
            $thriceBoxIdCount += in_array(3, $counts, true) ? 1 : 0;
        }

        return [$twiceBoxIdCount, $thriceBoxIdCount];
    }

    private function getRows()
    {
        return InputHelper::getRows($this->inputString);
    }

    private function getMostCommonBoxIds()
    {
        $idealPercentage = $this->getIdealPercentage();

        foreach ($this->getRows() as $row1) {
            foreach ($this->getRows() as $row2) {
                $percent = $this->getComparison($row1, $row2);

                if ((100 > $percent) && ($percent >= $idealPercentage)) {
                    return [$row1, $row2];
                }
            }
        }
        return [null, null];
    }

    /**
     * @return string
     */
    public function getCorrectBoxId()
    {
        list($box1, $box2) = $this->getMostCommonBoxIds();

        $correctBoxIds = [];
        $count = count(InputHelper::splitCharacters($box1));

        for ($i=0; $i < $count; $i++) {
            $correctBoxIds[] = ($box1[$i] === $box2[$i]) ? $box1[$i] : '';
        }

        return $this->joinCharacters($correctBoxIds);
    }


    private function joinCharacters(array $characters)
    {
        return implode('', $characters);
    }

    public function getComparison($string1, $string2)
    {
        similar_text($string1, $string2, $percent);

        return $percent;
    }

    private function getIdealPercentage()
    {
        $firstRow = $this->getRows()[0];
        $size = count(InputHelper::splitCharacters($firstRow));

        return ($size -1) / $size * 100;
    }

}