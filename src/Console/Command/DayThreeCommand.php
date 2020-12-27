<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayThreeCommand extends Command
{
    /**
     * @var string|false
     */
    private $inputString;

    /**
     * @var array<array<string>|string>
     */
    private array $map;

    protected function configure() : void
    {
        $this
            ->setName('day3')
            ->setDescription('Day 3: Toboggan Trajectory')
            ->addArgument('inputFile', null, 'newFile', 'day3.txt')
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('inputFile');
        if (is_string($file) )
            $this->inputString = file_get_contents($file);

        if ($input->getOption('part2')) {

            $result = 1;

            $lines = preg_split("/\n/", $this->inputString);
            $this->map = $this->prepareMap($lines,7);
            $slopes = [
                [1,1],
                [3,1],
                [5,1],
                [7,1],
                [1,2]
            ];
            foreach ($slopes as $slope) {
                $result *= $this->traverseAndFindTrees($slope);
            }

        } else {

            $lines = preg_split("/\n/", $this->inputString);
            $this->map = $this->prepareMap($lines);

            $result = $this->traverseAndFindTrees();

        }

        $output->writeln("result = " . $result);
        return Command::SUCCESS;

    }


    /**
     * @param string[] $lines
     * @param int      $multiplier
     *
     * @return array<array<string>>|array<string>
     *
     */
    public function prepareMap(array $lines, int $multiplier=3) : array
    {
        /** @var string[] $map */
        $map = [];

        $height = count($lines);
        $maxWidth = $multiplier * $height;
        $lastLineNumber = $height - 1;
//        echo "Hey!!! \n " . count(str_split($lines[$lastLineNumber])) . " " . $maxWidth . "\n";

        for ($i=count(str_split($lines[0])); $i<=$maxWidth; $i=count(str_split($map[$lastLineNumber]))) {
            foreach ($lines as $key => $line) {
                if (isset($map[$key]))
                    $map[$key] .= $line;
                else
                    $map[$key] = $line;
            }
        }

        foreach ($map as $key => $m) {
            $map[$key] = preg_split("//", $m,-1, PREG_SPLIT_NO_EMPTY) ?: '';
        }

//        echo "Hey!!! \n " . count(str_split($lines[$lastLineNumber])) . " " . $maxWidth . "\n";

        return $map;
    }

    /**
     * @param int   $posX
     * @param int   $posY
     * @param int[] $slope
     *
     * @return int[]
     */
    public function takeStep(int $posX, int $posY, array $slope)
    {
        return [$posX+$slope[0], $posY+$slope[1]];
    }

    /**
     * @param string $char
     *
     * @return bool
     */
    public function isTree(string $char)
    {
        return ($char === '#');
    }

    /**
     * @param int[] $slope
     *
     * @return int
     */
    private function traverseAndFindTrees(array $slope=[3,1]) : int
    {
        $height = count($this->map);
        $length = is_array($this->map[0]) ? count($this->map[0]) : 0;
        $treeCount = 0;

        for ($x=$y=0; $y<$height && $x<$length; list($x, $y)=$this->takeStep($x, $y, $slope)) {
            $treeCount += intval($this->isTree($this->map[$y][$x]));
        }

        return $treeCount;
    }

}
