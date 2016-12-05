<?php

namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DayFiveCommand extends Command
{

    /**
     * @var string
     */
    var $doorId = 'ugkcyxxp';

    var $currentIndex = 0;

    var $password = '';

    protected function configure()
    {
        $this
            ->setName('day5')
            ->setDescription('Day 5: How About a Nice Game of Chess?')
            ->addOption(
                'part2',
                null,
                InputOption::VALUE_NONE,
                'If set, the part two puzzle will be solved'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('part2')) {
            foreach (preg_split("/\n/", $this->input_string) as $line) {
                if (isset($line) && ($line != "")) {
                }
            }
        } else {
            while (strlen($this->password) < 8) {
                $this->hashIt($this->doorId, $this->currentIndex);

                $this->currentIndex++;
            }
        }
        $result = $this->password;
        $output->writeln("result = " . $result);
    }

    public function hashIt($door, $input)
    {
        $hashedString = md5($door.$input);

        if (substr($hashedString, 0, 5) === '00000') {

            $passwordCharacter = substr($hashedString, 5,1);

            var_dump($passwordCharacter, $hashedString);

            $this->password = $this->password . $passwordCharacter;
        }
    }

}