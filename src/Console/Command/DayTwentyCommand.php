<?php
/**
 * Created by PhpStorm.
 * User: elstamey
 * Date: 12/7/15
 * Time: 7:18 PM
 */

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayTwentyCommand extends Command
{
    /**
     * @var string
     */
    var $input_string = '33100000';

    var $houses = [];
    var $elves = [];

    protected function configure()
    {
        $this
            ->setName('day20')
            ->setDescription('Infinite Elves and Infinite Houses')
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->houses = array_fill(0,2000, 0);
        $this->elves = range(1,2000);

        if ($input->getOption('part2')) {

        } else {

            while (!$this->haveReachedGiftCount()) {
                foreach ($this->elves as $elf) {
//                    print("elf". ($key+1) . "\n");

                    for ($i=0; $i < count($this->houses); $i=($i+$elf+1)) {

                        $this->houses[$i] += ($elf * 10);
                    }
                }
                print("all elves have visited once");
            }



        }
        $result = $this->firstHouseAtGiftGoal();
        $output->writeln("result = " . $result);
    }

    private function elfGives($key)
    {
        return ($key* 10);
    }

    private function haveReachedGiftCount()
    {
        if (empty($this->firstHouseAtGiftGoal() )) {
            return false;
        }
        return true;
    }

    private function houseAtOrAboveGiftGoal($house)
    {
        return ($house >= $this->input_string);
    }

    private function firstHouseAtGiftGoal()
    {
        $houses = $this->houses;

        $firstHouse =  array_filter($houses, function ($v, $k) {
            if ($v >= $this->input_string) {
                return $k;
            }
        }, ARRAY_FILTER_USE_BOTH);

        if ( !isset($firstHouse[0]) || empty($firstHouse)) {
            return false;
        } else {
            return $firstHouse[0];
        }
    }

}