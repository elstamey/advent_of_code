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
     *
     */
    protected function configure(): void
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
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $result = 0;

        $file = $input->getArgument('inputFile');
        if (is_string($file)) {
            $this->inputString = file_get_contents($file);
        }

        $strictValidation = false;

        if (is_string($this->inputString) && $input->getOption('part2')) {

            $strictValidation = true;
            $result = $this->handlePassports($this->inputString, $strictValidation);

        } elseif (isset($this->inputString)) {
            $result = $this->handlePassports($this->inputString, $strictValidation);
        }

        $output->writeln("result = " . $result);
        return Command::SUCCESS;
    }

    /**
     * @param string $inputString
     * @param bool   $strictValidation
     *
     * @return int
     */
    public function handlePassports(string $inputString, bool $strictValidation) : int
    {
        $result = 0;
        $inputArray = preg_split('/\n\n/', $inputString);

        foreach ($inputArray as $passportFields) {

            $passport = $this->makePassport($passportFields, $strictValidation);

//            var_dump($passport, $passport->isValid());
            $result += intval($passport->isValid());
        }
        return $result;
    }

    /**
     * @param string $passportFields
     * @param bool   $strictValidation
     *
     * @return Passport
     */
    public function makePassport(string $passportFields, bool $strictValidation) : Passport
    {
        $fields = preg_split('/[\n|\s]/', $passportFields);
        $passport = new Passport();

        foreach ($fields as $f) {
            if ($f) {
                list($var, $val) = preg_split('/:/', $f);

                switch ($var) {
                    case 'byr':
                        $passport->setBirthYear($val, $strictValidation);
                        break;
                    case 'iyr':
                        $passport->setIssueYear($val, $strictValidation);
                        break;
                    case 'eyr':
                        $passport->setExpirationYear($val, $strictValidation);
                        break;
                    case 'hgt':
                        $passport->setHeight($val, $strictValidation);
                        break;
                    case 'hcl':
                        $passport->setHairColor($val, $strictValidation);
                        break;
                    case 'ecl':
                        $passport->setEyeColor($val, $strictValidation);
                        break;
                    case 'pid':
                        $passport->setPassportId($val, $strictValidation);
                        break;
                    case 'cid':
                        $passport->setCountryId($val);
                        break;
                    default:
                        break;
                }
            }

        } // end foreach $fields

        return $passport;
    }

}