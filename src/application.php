#!/usr/bin/env php
<?php
// application.php

require __DIR__ . '/../vendor/autoload.php';

use Acme\Console\Command\AdventPuzzleCommand;
use Acme\Console\Command\GreetCommand;
use Acme\Console\Command\DayTwoCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new GreetCommand());
$application->add(new AdventPuzzleCommand());
$application->add(new DayTwoCommand());
$application->run();