<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayThreeCommand extends Command
{
    protected int $validTriangles = 0;
    /**
     * @var string|false
     */
    private $inputString;

    /**
     * @var string[]
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



        } else {
            $values = [];

            $lines = preg_split("/\n/", $this->inputString);
            $this->map = $this->prepareMap($lines);


        }

        $result = $this->validTriangles;
        $output->writeln("result = " . $result);
        return Command::SUCCESS;

    }



    /**
     * @param string[] $lines
     *
     * @return string[]
     */
    public function prepareMap(array $lines) : array
    {
        $map = [];

        $height = count($lines);
        $maxWidth = 3 * $height;
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

//        echo "Hey!!! \n " . count(str_split($lines[$lastLineNumber])) . " " . $maxWidth . "\n";

        return $map;
    }

    /**
     * @param int $posX
     * @param int $posY
     *
     * @return int[]
     */
    public function takeStep(int $posX, int $posY)
    {
        return [$posX+3, $posY+1];
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

}
