<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayThreeCommand extends Command
{
    protected $validTriangles = 0;

    protected function configure()
    {
        $this
            ->setName('day3')
            ->setDescription('Day 3: Squares With Three Sides')
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
        $this->input_string = file_get_contents($input->getArgument('inputFile'));

        if ($input->getOption('part2')) {

            $this->validTriangles = 0;

            $groups = array_chunk(preg_split("/[\n]/", $this->input_string), 3);
            foreach ($groups as $group) {

                if (count($group) == 3) {
                    $g = $group[0] . $group[1] . $group[2];

                    if (isset($g) && ($g != "")) {
                        $x = preg_split("/[\s]+/", $g);

                        $this->testValidTriangle($x[1], $x[4], $x[7]);
                        $this->testValidTriangle($x[2], $x[5], $x[8]);
                        $this->testValidTriangle($x[3], $x[6], $x[9]);
                    }
                }
            }

        } else {
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                    $coords = preg_split("/[\s]+/", $line);

//                var_dump($coords);
//                print "\n";

                    $this->testValidTriangle($coords[1], $coords[2], $coords[3]);
                }
            }

        }

        $result = $this->validTriangles;
        $output->writeln("result = " . $result);
    }

    /**
     * @param int $a
     * @param int $b
     * @param int $c
     */
    public function testValidTriangle($a, $b, $c)
    {
        if ($this->isTriangle($a, $b, $c) &&
            $this->isTriangle($b, $c, $a) &&
            $this->isTriangle($c, $a, $b) ) {
            $this->validTriangles++;
        }
    }

    /**
     * @param int $a
     * @param int $b
     * @param int $c
     *
     * @return bool
     */
    public function isTriangle($a, $b, $c)
    {
        return (($a + $b) > $c);
    }

}
