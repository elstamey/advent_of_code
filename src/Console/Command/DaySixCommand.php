<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DaySixCommand extends Command
{

    private $inputString;

    public $photoAlbum = [];

    protected function configure()
    {
        $this
            ->setName('day6')
            ->setDescription('Day 6: Signals and Noise')
            ->addArgument('inputFile', null, 'newFile', 'day6.txt')
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
        $lines = preg_split("/\n/", $this->inputString);
        $memoryBanks = $lines[0];
        $memoryBanks = preg_split('/\s/', $memoryBanks);

        $count = 0;

        while ($this->checkForPreviouslySeenConfig($memoryBanks) !== true) {
            $memoryBanks = $this->redistribute($memoryBanks);
            $count++;
        }

        if ($input->getOption('part2')) {

            $count = 1;

            $snapshot = implode(' ', $memoryBanks);
            $memoryBanks = $this->redistribute($memoryBanks);

            while ($this->isSameConfig($snapshot, $memoryBanks) !== true) {
                $memoryBanks = $this->redistribute($memoryBanks);
                $count++;
            }
        }

        $output->writeln("result = " . $count);
    }

    public function redistribute($memoryBanks)
    {
        $count = count($memoryBanks);
        $key = $this->findKeyOfLargest($memoryBanks);
        $most = $memoryBanks[$key];
        $memoryBanks[$key] = 0;

        for ($i=$most; $i > 0; $i--) {
            $ptr = $key + 1;
            $key = ($ptr < $count) ? $ptr : ($ptr - $count);
            $memoryBanks[$key]++;
        }

        return $memoryBanks;
    }

    public function findKeyOfLargest($memoryBanks)
    {
        $maxs = array_keys($memoryBanks, max($memoryBanks));

        return $maxs[0];
    }

    public function checkForPreviouslySeenConfig($memoryBanks)
    {
        $snapshot = implode(' ', $memoryBanks);

        if (in_array($snapshot, $this->photoAlbum, true)) {
            return true;
        }

        array_push($this->photoAlbum, $snapshot);

        return false;
    }

    public function isSameConfig($snapshot, $memoryBanks)
    {
        $current = implode(' ', $memoryBanks);

        return ($snapshot === $current);
    }
}