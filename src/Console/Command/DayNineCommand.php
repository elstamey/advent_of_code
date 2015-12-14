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

class DayNineCommand extends Command
{
    /**
     * @var string
     */
    var $input_string = 'bgvyzdsv';

    var $locations = [];

    var $distances = [];

    protected function configure()
    {
        $this
            ->setName( 'day9' )
            ->setDescription( 'All in a Single Night' )
            ->addArgument( 'inputFile', null, 'newFile', 'day9.txt' )
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            );
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        $this->input_string = file_get_contents( $input->getArgument( 'inputFile' ) );

        if ($input->getOption( 'part2' )) {
            foreach (preg_split( "/\n/", $this->input_string ) as $line) {
                if (isset( $line ) && ( $line != "" )) {
                }
            }
        } else {
            foreach (preg_split( "/\n/", $this->input_string ) as $line) {
                if (isset( $line ) && ( $line != "" )) {
                    $lArray = preg_split("/[\ \=]+/", $line);
                    print($lArray[0]." ".$lArray[2]." ".$lArray[3]."\n");
                    $loc1 = $lArray[0];
                    $loc2 = $lArray[2];
                    $dist = $lArray[3];
                    $this->setLocations($loc1, $loc2);
                    $this->saveDistance($loc1, $loc2, $dist);
                }
            }
        }
//        $output->writeln( "result = " . $result );
    }

    private function setLocations( $loc1, $loc2 )
    {
        if (!in_array($loc1, $this->locations)) {
            array_push($this->locations, $loc1);
        }
        if (!in_array($loc2, $this->locations)) {
            array_push($this->locations, $loc2);
        }
    }

    private function saveDistance( $loc1, $loc2, $dist )
    {
        $this->distances[$loc1][$loc2] = $dist;
        $this->distances[$loc2][$loc1] = $dist;
    }
}