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
            ->setDescription('Day 4: High-Entropy Passphrases')
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
        $this->inputString = file_get_contents($input->getArgument('inputFile'));

        if ($input->getOption('part2')) {
            $result = '';

            foreach (preg_split("/\n/", $this->inputString) as $line) {
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
            $result = 0;

            foreach (preg_split("/\n/", $this->inputString) as $line) {
                if (isset($line) && ($line != "")) {
                    $result += (int) $this->isValidPassword($line);
                }
            }

        }

        $output->writeln("result = " . $result);
    }


    public function isValidPassword($line)
    {
//        print "\nTest output: " . $line . "\n";

        $words = preg_split('/\s/', $line);

        $searchTheseWords = $words;
        foreach ($words as $word) {
//            print "word " . $word . ": " . $line . "\n";
            array_shift($searchTheseWords);
            if (in_array($word, $searchTheseWords, true)) {
                return false;
            }
        }

        return true;
    }

    public function passwordDoesNotContainAnagrams($line)
    {
        print "\nTest output: " . $line . "\n";

        $words = preg_split('/\s/', $line);

        $searchTheseWords = $words;
        foreach ($words as $word) {
            array_shift($searchTheseWords);
            print "word " . $word . ": " . implode(' ', $searchTheseWords) . "\n";

            foreach ($searchTheseWords as $search) {
                if (count_chars($word,1) == count_chars($search, 1)) {
                    print "FALSE! \n";
                    return false;
                }
            }
        }

        print "TRUE\n";
        return true;
    }
}