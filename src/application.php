#!/usr/bin/env php
<?php
// application.php

require __DIR__ . '/../vendor/autoload.php';

use Acme\Console\Command\GreetCommand;
use Acme\Console\Command\DayOneCommand;
use Acme\Console\Command\DayTwoCommand;
use Acme\Console\Command\DayBlankCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new GreetCommand());
$application->add(new DayOneCommand());
$application->add(new DayTwoCommand());
$application->add(new DayBlankCommand());
$application->run();