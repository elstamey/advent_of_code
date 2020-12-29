<?php

		namespace Console\Models;

		use Acme\Console\Models\Rules;
		use PHPUnit\Framework\TestCase;

        class RulesTest extends TestCase
		{
		    public function testFindBagsContaining() : void
		    {
		         $inputs = ['light red bags contain 1 bright white bag, 2 muted yellow bags.',
                        'dark orange bags contain 3 bright white bags, 4 muted yellow bags.',
                        'bright white bags contain 1 shiny gold bag.',
                        'muted yellow bags contain 2 shiny gold bags, 9 faded blue bags.',
                        'shiny gold bags contain 1 dark olive bag, 2 vibrant plum bags.',
                        'dark olive bags contain 3 faded blue bags, 4 dotted black bags.',
                        'vibrant plum bags contain 5 faded blue bags, 6 dotted black bags.',
                        'faded blue bags contain no other bags.',
                        'dotted black bags contain no other bags.'];

		        $rules = new Rules();
                foreach ($inputs as $ruleString) {
                    $rules->createFromString($ruleString);
                }
		        self::assertContains('muted yellow', $rules->findBagsContaining('shiny gold'));
		        self::assertContains('bright white', $rules->findBagsContaining('shiny gold'));
		    }

            public function testCountBagsContaining() : void
            {
                $inputs = ['light red bags contain 1 bright white bag, 2 muted yellow bags.',
                    'dark orange bags contain 3 bright white bags, 4 muted yellow bags.',
                    'bright white bags contain 1 shiny gold bag.',
                    'muted yellow bags contain 2 shiny gold bags, 9 faded blue bags.',
                    'shiny gold bags contain 1 dark olive bag, 2 vibrant plum bags.',
                    'dark olive bags contain 3 faded blue bags, 4 dotted black bags.',
                    'vibrant plum bags contain 5 faded blue bags, 6 dotted black bags.',
                    'faded blue bags contain no other bags.',
                    'dotted black bags contain no other bags.'];

                $rules = new Rules();
                foreach ($inputs as $ruleString) {
                    $rules->createFromString($ruleString);
                }

                self::assertEquals(0, $rules->countBagsInside('faded blue'));
                self::assertEquals(0, $rules->countBagsInside('dotted black'));
                self::assertEquals(11, $rules->countBagsInside('vibrant plum'));
                self::assertEquals(7, $rules->countBagsInside('dark olive'));
		    }
		}
