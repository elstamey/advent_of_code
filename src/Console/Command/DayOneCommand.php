<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class DayOneCommand extends Command
{
    private $input_string = '';


    protected function configure()
    {
        $this
            ->setName('day1')
            ->setDescription('Inverse Captcha')
            ->addArgument('inputFile', null, 'newFile', 'day1.txt')
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
            if (isset($this->input_string)) {
                $result = $this->calculateRepeatVisits( $this->input_string );
            }
        } else {
            if (isset($this->input_string)) {
                $result = $this->addRepeatDigits( $this->input_string );
            }
        }

        $output->writeln("result = " . $result);
    }

    /**
     *
     */
    public function addRepeatDigits($inputString)
    {
        $total = 0;

        $digits = str_split(preg_replace(['/\s+/', '/[\t\n]/'], '', $inputString));
        array_push($digits, $digits[0]);
        $max = count($digits) - 1;

        for ($i=0; $i < $max; $i++) {
            if ($digits[$i] === $digits[$i+1]) {
                print($digits[$i] . "\n");
                $total += $digits[$i];
            }
        }

        return $total;
    }

}