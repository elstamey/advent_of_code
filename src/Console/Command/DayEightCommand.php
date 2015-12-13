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

class DayEightCommand extends Command
{
    /**
     * @var string
     */
    var $input_string = 'bgvyzdsv';

    var $stringLength = 0;
    var $codeLength = 0;

    protected function configure()
    {
        $this
            ->setName('day8')
            ->setDescription('The Ideal Stocking Stuffer')
            ->addArgument('inputFile', null, 'newFile', 'day8.txt')
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
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                }
            }
            $result = '';
        } else {
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                    $this->codeLength += (strlen($line) - 2);
                    $this->stringLength += $this->countStringLiteralChars($line);
                }
            }
            $result = $this->stringLength - $this->codeLength;
        }
        $output->writeln("result = " . $result);
    }

    private function countStringLiteralChars( $line )
    {
        preg_replace("/\\\\/"," ", $line);
        preg_replace("/\\\"/"," ", $line);
        $line = $this->replaceHexChars($line);

        return strlen($line);
    }

    private function replaceHexChars( $line )
    {
        preg_replace("/\\[x][0-9][0-9]/", "/X/", $line);
        return $line;
    }

}