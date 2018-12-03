<?php

namespace Acme\Console\Command;

use Acme\InputHelper;
use Acme\Rectangle;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayThreeCommand extends Command
{
    protected $inputString;
    protected $matrix;


    protected function configure()
    {
        $this
            ->setName('day3')
            ->setDescription('Day 3: No Matter How You Slice It')
            ->addArgument('inputFile', null, 'newFile', 'day3.txt')
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->inputString = file_get_contents($input->getArgument('inputFile'));

        if ($input->getOption('part2')) {

        }

        $result = $this->getOverlappedClaims();
        $output->writeln("result = " . $result);
    }

    private function getOverlappedClaims()
    {
        $rectangle = new Rectangle(0, 0, 0, 1000, 1000);
        $this->matrix = $rectangle->buildEmptyMatrix();

        $claims = InputHelper::getRows($this->inputString);
        $this->updateMatrixWith($claims);
    }

    private function updateMatrixWith(array $claims)
    {
        foreach ($claims as $claim) {
            $rectangle = $this->buildRectangleFromLine($claim);
            $rectangle->buildMatrix();

            $this->updateMatrixWithRectangle($rectangle);
        }
    }

    private function buildRectangleFromLine($claim)
    {
        $rectangleData = InputHelper::splitRowBySpace($claim);

        return $this->buildRectangleFromData($rectangleData);
    }

    private function buildRectangleFromData($rectangleData)
    {
        $id = preg_match('/\#(\d+)/', $rectangleData[0]);

        $edges = InputHelper::splitRowByComma($rectangleData[2]);
        $leftEdge = $edges[0];
        $rightEdge = preg_replace('/\:/', '', $edges[1]);

        list($width, $height) = InputHelper::splitRowByX($rectangleData[3]);

        return new Rectangle($id, $leftEdge, $rightEdge, $width, $height);
    }

    private function updateMatrixWithRectangle($rectangle)
    {
        $x = count($this->matrix[0]);
        $y = count($this->matrix);
        for ($i=0; $i < $x; $i++){
            for ($j=0; $j < $y; $j++) {

            }
        }

    }
}
