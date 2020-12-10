<?php

use Acme\Console\Command\DayFourCommand;
use Symfony\Component\Console\Application;
use \Symfony\Component\Console\Tester\CommandTester;

class DayFourCommandTest extends PHPUnit\Framework\TestCase
{

//    /** @test */
    public function testExecute() : void
    {
        $application = new Application();
        $application->add(new DayFourCommand());

        $command = $application->find('day4');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday4.txt',

        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('result = 2', $output);
    }

//    /** @test */
    public function testExecutePartTwo() : void
    {
        $application = new Application();
        $application->add(new DayFourCommand());

        $command = $application->find('day4');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'inputFile' => 'testday4b.txt',

            // prefix the key with a double slash when passing options,
            // e.g: '--some-option' => 'option_value',
            '--part2' => true,

        ));


        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('result = 4', $output);
    }

    public function testStrictValidPassports() : void
    {
        $inputString = 'pid:087499704 hgt:74in ecl:grn iyr:2012 eyr:2030 byr:1980
hcl:#623a2f

eyr:2029 ecl:blu cid:129 byr:1989
iyr:2014 pid:896056539 hcl:#a97842 hgt:165cm

hcl:#888785
hgt:164cm byr:2001 iyr:2015 cid:88
pid:545766238 ecl:hzl
eyr:2022

iyr:2010 hgt:158cm hcl:#b6652a ecl:blu byr:1944 eyr:2021 pid:093154719';

        $command = new DayFourCommand();

        $this->assertEquals(4, $command->handlePassports($inputString, true));
    }

    public function testFirstValidPassports() : void
    {
        $input = 'pid:087499704 hgt:74in ecl:grn iyr:2012 eyr:2030 byr:1980
hcl:#623a2f';

        $command = new DayFourCommand();
        $passport = $command->makePassport($input, true);
        $this->assertTrue($passport->isValid(), 'Did not return true '.$input.' height '.$passport->getHeight());

    }

    public function testSecondValidPassports() : void
    {
        $input = 'eyr:2029 ecl:blu cid:129 byr:1989
iyr:2014 pid:896056539 hcl:#a97842 hgt:165cm';

        $command = new DayFourCommand();
        $passport = $command->makePassport($input, true);
        $this->assertTrue($passport->isValid(), 'Did not return true '.$input.' eyr '.$passport->getExpirationYear());

    }

    public function testThirdValidPassports() : void
    {
        $input = 'eyr:2029 ecl:blu cid:129 byr:1989
iyr:2014 pid:896056539 hcl:#a97842 hgt:165cm';

        $command = new DayFourCommand();
        $passport = $command->makePassport($input, true);
        $this->assertTrue($passport->isValid(), 'Did not return true '.$input.' hcl '.$passport->getHairColor());

    }


    public function testFourthValidPassports() : void
    {
        $input = 'iyr:2010 hgt:158cm hcl:#b6652a ecl:blu byr:1944 eyr:2021 pid:093154719';

        $command = new DayFourCommand();
        $passport = $command->makePassport($input, true);
        $this->assertTrue($passport->isValid(), 'Did not return true '.$input.' height '.$passport->getHeight());

    }

    public function testStrictInvalidPassports() : void
    {
        $inputString = 'eyr:1972 cid:100
hcl:#18171d ecl:amb hgt:170 pid:186cm iyr:2018 byr:1926

iyr:2019
hcl:#602927 eyr:1967 hgt:170cm
ecl:grn pid:012533040 byr:1946

hcl:dab227 iyr:2012
ecl:brn hgt:182cm pid:021572410 eyr:2020 byr:1992 cid:277

hgt:59cm ecl:zzz
eyr:2038 hcl:74454a iyr:2023
pid:3556412378 byr:2007';

        $command = new DayFourCommand();

        $this->assertEquals(0, $command->handlePassports($inputString, true));

    }

    public function testFirstInvalidPassports() : void
    {
        $input = 'eyr:1972 cid:100
hcl:#18171d ecl:amb hgt:170 pid:186cm iyr:2018 byr:1926';

        $command = new DayFourCommand();
        $passport = $command->makePassport($input, true);
        $this->assertFalse($passport->isValid(), 'Did not return false '.$input.' height '.$passport->getHeight());

    }

    public function testSecondInvalidPassports() : void
    {
        $input = 'iyr:2019
hcl:#602927 eyr:1967 hgt:170cm
ecl:grn pid:012533040 byr:1946';

        $command = new DayFourCommand();
        $passport = $command->makePassport($input, true);
        $this->assertFalse($passport->isValid(), 'Did not return false '.$input.' eyr '.$passport->getExpirationYear());

    }

    public function testThirdInvalidPassports() : void
    {
        $input = 'hcl:dab227 iyr:2012
ecl:brn hgt:182cm pid:021572410 eyr:2020 byr:1992 cid:277';

        $command = new DayFourCommand();
        $passport = $command->makePassport($input, true);
        $this->assertFalse($passport->isValid(), 'Did not return false '.$input.' hcl '.$passport->getHairColor());

    }


    public function testFourthInvalidPassports() : void
    {
        $input = 'hgt:59cm ecl:zzz
eyr:2038 hcl:74454a iyr:2023
pid:3556412378 byr:2007';

        $command = new DayFourCommand();
        $passport = $command->makePassport($input, true);
        $this->assertFalse($passport->isValid(), 'Did not return false '.$input.' height '.$passport->getHeight());

    }

}
