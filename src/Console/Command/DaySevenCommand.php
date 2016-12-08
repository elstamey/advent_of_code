<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DaySevenCommand extends Command
{
    /**
     * @var string
     */
    var $input_string = 'bgvyzdsv';


    protected function configure()
    {
        $this
            ->setName('day7')
            ->setDescription('The Ideal Stocking Stuffer')
            ->addArgument('inputFile', null, 'newFile', 'day7.txt')
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
        } else {
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                }
            }
        }
        $result = '';
        $output->writeln("result = " . $result);
    }

    public function isAbba($textString)
    {
        preg_match('/.*(\w)(\w)\2\1.*/', $textString);

//        $splitString = str_split($textString, (strlen($textString)/2));
//
//        print $textString. " is ". intval($splitString[0]  === strrev($splitString[1])). " \n";
//        return ($splitString[0]  === strrev($splitString[1]));

//        print $textString. " " . var_dump($matches). "\n";
        return (preg_match('/.*(\w)(\w)\2\1.*/', $textString) === 1);
    }

    public static function supportsTLS($failLine)
    {
        preg_match_all('/(?P<seq>\w+)\[(?P<hypernet>\w+)\]/', $failLine, $out, PREG_PATTERN_ORDER);

//        var_dump($out);

        print $failLine . " is ". (((DaySevenCommand::isAbba($out['seq'][0]) == true) && (DaySevenCommand::isAbba($out['hypernet'][0]) == false))) . " \n";

        return (((DaySevenCommand::isAbba($out['seq'][0]) == true) && (DaySevenCommand::isAbba($out['hypernet'][0]) == false)));

    }

}