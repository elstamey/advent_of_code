<?php

namespace Console\Models;

use Acme\Console\Models\Passport;
use PHPUnit\Framework\TestCase;

class PassportTest extends TestCase
{
    public function testIsValid() : void
    {
        $passport = new Passport();
        $p1 = $passport->createFromInputs(1937, 2017, 2020, '183cm',
                            '#fffffd', 'gry', '860033327', 147);
        $this->assertTrue($p1->isValid());

        $p2 = $passport->createFromInputs(1929, 2023, 2023, null,
                            '#cfa07d', 'amb', '028048884', 350);
        $this->assertFalse($p2->isValid());

        $p3 = $passport->createFromInputs(1931, 2013, 2024, '179cm',
                            '#ae17e1', 'brn', '760753108', 350);
        $this->assertTrue($p3->isValid());

        $p4 = $passport->createFromInputs(null, 2011, 2025, '59in',
            '#cfa07d', 'brn', '166559648', null);
        $this->assertFalse($p4->isValid());
    }
}
