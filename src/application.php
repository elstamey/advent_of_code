#!/usr/bin/env php
<?php
// application.php

require __DIR__ . '/../vendor/autoload.php';

use Acme\Console\Command\GreetCommand;
use Acme\Console\Command\DayOneCommand;
use Acme\Console\Command\DayTwoCommand;
use Acme\Console\Command\DayThreeCommand;
use Acme\Console\Command\DayFourCommand;
use Acme\Console\Command\DayFiveCommand;
use Acme\Console\Command\DaySixCommand;
use Acme\Console\Command\DaySevenCommand;
use Acme\Console\Command\DayEightCommand;
use Acme\Console\Command\DayTwelveCommand;
use Acme\Console\Command\DayBlankCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->addCommand(new GreetCommand());
$application->addCommand(new DayOneCommand());
$application->addCommand(new DayTwoCommand());
$application->addCommand(new DayThreeCommand());
$application->addCommand(new DayFourCommand());
$application->addCommand(new DayFiveCommand());
$application->addCommand(new DaySixCommand());
$application->addCommand(new DaySevenCommand());
$application->addCommand(new DayEightCommand());
$application->addCommand(new DayTwelveCommand());
$application->addCommand(new DayBlankCommand());
$application->run();