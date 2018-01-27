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
            ->setDescription('Day 7: Recursive Circus')
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

        } else {

        }

        foreach (preg_split("/\n/", $this->input_string) as $line) {
            if (isset($line) && ($line != "")) {
                $program = preg_split('/[->]/', $line, null, PREG_SPLIT_NO_EMPTY);

                die(var_dump($program));
            }
        }

        $result = $this->total;
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


    public function getAbasFromString($net)
    {
        $returnArray = [];

            $letters = str_split($net,1);
            for ($i=0; $i < (count($letters) - 2); $i++) {

                $myString = substr($net, $i, 3);
                if (($letters[$i] !== $letters[$i+1]) && ($letters[$i] === $letters[$i+2])) {
                    array_push($returnArray, $myString);
                }

            }
//        var_dump($returnArray);

        return $returnArray;
    }


    private function supportsSSL($line)
    {
        $supernets = $this->getSupernetsFromString($line);
        $hypernets = $this->getHypernetsFromString($line);

//        var_dump($supernets, $hypernets);

        $abas = [];
        foreach ($supernets as $supernet) {
            foreach ($this->getAbasFromString($supernet) as $aba) {
                array_push($abas, $aba);
            }
        }

        $babs = [];
        foreach ($hypernets as $hypernet) {
            foreach ($this->getAbasFromString($hypernet) as $bab) {
                array_push($babs, $bab);
            }
        }

//        var_dump($abas, $babs);

        if (!empty($abas) && !empty($babs)) {

            foreach ($abas as $aba) {
                preg_match('/(\w)(\w)\1/', $aba, $out);
                $bab = $out[2] . $out[1] . $out[2];

//                var_dump($aba,$bab, $babs);


                if (array_search($bab, $babs) !== false) {
//                    print "match\n";
                    return true;
                }
//                print "\n";
            }
        }

        return false;
    }

    private function getSupernetsFromString($line)
    {
        preg_match_all('/([a-zA-Z]+)\[[a-zA-Z]+\]([a-zA-Z]+)/', $line, $supernets);
//        unset($supernets[0]);


        return array_merge($supernets[1], $supernets[2]);
    }

    private function getHypernetsFromString($line)
    {
        preg_match_all('/\w+\[(\w+)\]\w+/', $line, $hypernets);
        unset($hypernets[0]);

//        var_dump($hypernets);


        return $hypernets[1];
    }



}