<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Acme\Console\Models\Passport;

class DayFourCommand extends Command
{
    /**
     * @var false|string
     */
    private $inputString;

    /**
     * @var string[]
     */
    private array $inputArray;


    /**
     *
     */
    protected function configure() : void
    {
        $this
            ->setName('day4')
            ->setDescription('Day 4: Passport Processing')
            ->addArgument('inputFile', null, 'newFile', 'day4.txt')
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
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output) : int
    {

        $result = 0;

        $file = $input->getArgument('inputFile');
        if (is_string($file) )
            $this->inputString = file_get_contents($file);

        if (isset($this->inputString) && is_string($this->inputString) && $input->getOption('part2')) {



        } elseif (isset($this->inputString)) {

            $this->inputArray = preg_split('/\n\n/', $this->inputString);

            print "Here: " . count($this->inputArray) . "\n";

            foreach ($this->inputArray as $passportFields) {
                $fields = preg_split('/[\n|\s]/', $passportFields);
                $passport = new Passport();

                foreach ($fields as $f) {
                    if ($f) {
                        list($var, $val) = preg_split('/:/', $f);

                        switch ($var) {
                            case 'byr':
                                $passport->setBirthYear($val);
                                break;
                            case 'iyr':
                                $passport->setIssueYear($val);
                                break;
                            case 'eyr':
                                $passport->setExpirationYear($val);
                                break;
                            case 'hgt':
                                $passport->setHeight($val);
                                break;
                            case 'hcl':
                                $passport->setHairColor($val);
                                break;
                            case 'ecl':
                                $passport->setEyeColor($val);
                                break;
                            case 'pid':
                                $passport->setPassportId($val);
                                break;
                            case 'cid':
                                $passport->setCountryId($val);
                                break;
                            default:
                                break;
                        }
                    }

                } // end foreach $fields
//                var_dump($passport);
                $result += intval($passport->isValid());
            }

        }

        $output->writeln("result = " . $result );
        return Command::SUCCESS;
    }


}