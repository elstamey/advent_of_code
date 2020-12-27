<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayFiveCommand extends Command
{

    /**
     * @var string
     */
    private string $inputString;

    /**
     * @var null|string[]
     */
    private ?array $inputArray;

    /**
     * @var int[]
     */
    private array $seatIds;

    /**
     * @var int[][]
     */
    private array $occupiedSeats;

    protected function configure() : void
    {
        $this
            ->setName('day5')
            ->setDescription('Day 5: Binary Boarding')
            ->addArgument('inputFile', null, 'newFile', 'day5.txt')
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
        $result = 0;
        $file = $input->getArgument('inputFile');
        if (is_string($file) )
            $this->inputString = file_get_contents($file);

        if (isset($this->inputString) && is_string($this->inputString) && $input->getOption('part2')) {

            $this->inputArray = preg_split('/\n/', $this->inputString);

            foreach ($this->inputArray as $boardingPass) {
                $seat = $this->getSeat($boardingPass);
                if (is_array($seat)) {
                    $seatId = $this->getSeatId($seat[0], $seat[1]);
                    $this->occupiedSeats[] = [$seat[0], $seat[1], $seatId];
                    $this->seatIds[] = $seatId;
                }
            }

            $result = $this->findMySeat();


        } elseif (isset($this->inputString)) {

            $this->inputArray = preg_split('/\n/', $this->inputString);

            foreach ($this->inputArray as $boardingPass) {
                $seat = $this->getSeat($boardingPass);
                if (is_array($seat)) {
                    $this->seatIds[] = $this->getSeatId($seat[0], $seat[1]);
                }
            }

            $result = $this->getHighestSeatId($this->seatIds);



        }

        if (is_int($result) && ($result>0)) {
            $output->writeln('result = ' . $result);
            return Command::SUCCESS;
        }

        $output->writeln('<error>Could not execute</error>');
        return Command::FAILURE;
    }


    /**
     * @param int[] $rows
     *
     * @return int[]
     */
    public function getLowerHalf(array $rows) : array
    {
        $halfPos = $rows[0] + intdiv(($rows[1] - $rows[0]), 2);

        return [$rows[0], $halfPos];
    }


    /**
     * @param int[] $rows
     *
     * @return int[]
     */
    public function getUpperHalf(array $rows) : array
    {
        $halfPos = $rows[0] + intdiv(($rows[1] - $rows[0]), 2) + 1;

        return [$halfPos, $rows[1]];
    }

    public function getSeatId(int $row, int $col) : int
    {
        return ((8 * $row) + $col);
    }

    /**
     * @param int[] $boardingPasses
     *
     * @return int
     */
    public function getHighestSeatId(array $boardingPasses) : int
    {
        return !empty($boardingPasses) ? max($boardingPasses) : 0;
    }

    /**
     * @param string $boardingPass
     *
     * @return int[]|null
     */
    public function getSeat(string $boardingPass) : ?array
    {
        $moves = str_split($boardingPass);
        $rows = [0, 127];
        $cols = [0, 7];

        foreach ($moves as $move) {
            switch ($move) {
                case 'F':
                    $rows = $this->getLowerHalf($rows);
                    break;
                case 'B':
                    $rows = $this->getUpperHalf($rows);
                    break;
                case 'L':
                    $cols = $this->getLowerHalf($cols);
                    break;
                case 'R':
                    $cols = $this->getUpperHalf($cols);
                    break;

            }
        }

        if (($cols[0] == $cols[1]) && ($rows[0] == $rows[1])) {
            return [$rows[0], $cols[0]];
        }

        return null;
    }

    public function findMySeat() : int
    {
        // traverse seats row 1 to row 126
        for ($row=1; $row<127; $row++) {
            for ($col=0; $col<8; $col++) {
                $seatId = $this->getSeatId($row, $col);
                if ($this->isSeatAvailable($row, $col, $seatId) && $this->areNearbySeatsAvailable($seatId)) {
                    return $seatId;
                }
            }
        }
        return 0;
    }

    private function isSeatAvailable(int $row, int $col, int $seatId) : bool
    {
        return !in_array([$row, $col, $seatId], $this->occupiedSeats, true);
    }

    private function areNearbySeatsAvailable(int $seatId) : bool
    {
        return (in_array($seatId+1, $this->seatIds) && in_array($seatId-1, $this->seatIds));
    }

}