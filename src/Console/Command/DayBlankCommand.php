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

class DayBlankCommand extends Command
{
    /**
     * @var string
     */
    var $input_string = 'bgvyzdsv';

    protected function configure()
    {
        $this
            ->setName('dayblank')
            ->setDescription('The Ideal Stocking Stuffer')
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        if ($input->getOption('part2')) {

        } else {

        }

        $output->writeln("result = " . $result);
    }

}