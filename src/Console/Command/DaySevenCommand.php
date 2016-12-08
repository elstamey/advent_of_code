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
     * @var int
     */
    var $total = 0;


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
            $result = '';
        } else {
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                    $this->total += intval($this->supportsTLS($line));
                }
            }
            $result = $this->total;
        }
        $output->writeln("result = " . $result);
    }

    public function isAbba($textString)
    {
        preg_match('/(\w)(\w)\2\1/', $textString, $out);
//        var_dump($out);

//        print $textString. " " . intval((preg_match('/.*(\w)(\w)\2\1.*/', $textString) === 1) && ($out[1] !== $out[2])). "\n";
        return (preg_match('/(\w)(\w)\2\1/', $textString) === 1) && ($out[1] !== $out[2]);
    }

    public function supportsTLS($wholeLine)
    {
        if ( ! $this->isAbba($wholeLine)) {
            return false;
        }

        preg_match_all('/\[([a-zA-Z]+)\]/', $wholeLine, $hypernets);

        foreach ($hypernets[1] as $hypernet) {
            if ($this->isAbba($hypernet))
                return false;
        };

        return true;
    }


//        print $failLine . " is ". (((DaySevenCommand::isAbba($out['seq'][0]) == true) && (DaySevenCommand::isAbba($out['hypernet'][0]) == false))) . " \n";

        $hyperNetBool = array_filter($out['hypernet'], function($v) { return (DaySevenCommand::isAbba($v) === false); });
        $sequenceBool = array_filter($out['seq'], function($v) { return (DaySevenCommand::isAbba($v) === true); });


        return ( $sequenceBool && $hyperNetBool);

    }

}