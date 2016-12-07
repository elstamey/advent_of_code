<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayFourCommand extends Command
{

    /**
     * @var int
     */
    private $sumOfSectorIds = 0;


    protected function configure()
    {
        $this
            ->setName('day4')
            ->setDescription('Day 4: Security Through Obscurity')
            ->addArgument('inputFile', null, 'newFile', 'day4.txt')
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
            $result = '';

            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "") && $this->isRealRoom($line)) {
                    $name = $this->decryptName($line) . "\n";

                    print $name . "\n";

                    if (strpos($name, 'north') !== false) {
                        preg_match('#([\w\-]+)([\d]{3})\[([\w]+)\]#', $line, $matches);

//                        var_dump($matches);
                        $result = $matches[2] . " " . $line;
                    }
                }
            }


        } else {
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                    $this->isRealRoom($line);

//                    print "Sector Sum: " . $this->getSectorSum() . "\n";
                }
            }

            $result = $this->getSectorSum();
        }

        $output->writeln("result = " . $result);
    }

    /**
     * @param string $roomInfo
     *
     * @return bool
     */
    protected function isRealRoom($roomInfo)
    {
        preg_match('#([\w\-]+)([\d]{3})\[([\w]+)\]#', $roomInfo, $matches);

        $roomName = preg_replace("/-/", "", $matches[1]);
        $sectorId = $matches[2];
        $checksum = $matches[3];

        $roomNameParts = str_split($roomName, 1);
        $reduce = array_count_values($roomNameParts);
        array_multisort(array_values($reduce), SORT_DESC, array_keys($reduce), SORT_ASC, $reduce);

        $reduce = array_slice($reduce, 0, 5);
        $roomNameParts = array_keys($reduce);
        natsort($roomNameParts);


        $checkSumArray = str_split($checksum, 1);

        if ( count(array_intersect($roomNameParts, $checkSumArray)) === 5) {
//            print "sector id: " . $sectorId . "\n";
            $this->sumOfSectorIds += $sectorId;
            return true;
        } else {
//            print "NOT REAL!!!! ------\n";
//            var_dump($reduce, $roomNameParts, $checkSumArray);
//            print "\n";
            return false;
        }

    }

    /**
     * @return int
     */
    public function getSectorSum()
    {
        return $this->sumOfSectorIds;
    }


    /**
     * @param string $encryptedName
     *
     * @return string
     */
    public function decryptName($encryptedName)
    {
        preg_match('#([\w\-]+)([\d]{3})#', $encryptedName, $matches);
        $words = preg_split("/-/", $matches[1]);
        $sectorId = $matches[2];

//        var_dump($words, $sectorId);

        $shiftAmount = $this->calculateShiftAmount($sectorId);
        $decryptedName = '';
        foreach ($words as $word) {
            foreach ( str_split($word, 1) as $letter ) {
                $decryptedName .= $this->shiftCipher($letter, $shiftAmount);

            }
            $decryptedName .= ' ';
        }

        return $decryptedName;
    }

    public function shiftCipher($letter, $moveAmount)
    {
        $alphabet = str_split('abcdefghijklmnopqrstuvwxyz', 1);
//        die(var_dump($alphabet));

        $key = array_search($letter, $alphabet);
        $moveAmount += $key;

        if ($moveAmount > 25) {
            $moveAmount -= 26;
        }

//        var_dump($letter, $key);

        return $alphabet[$moveAmount];
    }

    private function calculateShiftAmount($sectorId)
    {
        $moveAmount = $sectorId % 26;

        return $moveAmount;
    }

}