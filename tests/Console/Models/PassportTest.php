<?php

namespace Console\Models;

use Acme\Console\Models\Passport;
use PHPUnit\Framework\TestCase;

class PassportTest extends TestCase
{
    public function testIsValid()
    {
        $p1 = new Passport(1937, 2017, 2020, '183cm',
                            '#fffffd', 'gry', 860033327, 147);
        $this->assertTrue($p1->isValid());
    }
}
