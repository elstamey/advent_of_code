<?php

namespace Console\Models;

use Acme\Console\Models\Passport;
use PHPUnit\Framework\TestCase;

class PassportTest extends TestCase
{
    public function testIsValid() : void
    {
        $p1 = new Passport(1937, 2017, 2020, '183cm',
                            '#fffffd', 'gry', '860033327', 147);
        $this->assertTrue($p1->isValid());

        $p2 = new Passport(192937, 2013, 2023, null,
                            '#cfa07d', 'amb', '028048884', 350);
        $this->assertTrue($p2->isValid());
    }
}
