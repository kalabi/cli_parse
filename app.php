<?php

use Cli\CliCommand;
use Cli\CliFacade;

require 'vendor/autoload.php';

$appCommands = new CliFacade();

$newCommand = new CliCommand();
$newCommand->setName('Test_Command');
$newCommand->setDescription('Test command, do nothing');
$newCommand->setCallback(function () {
    print('do nothing' . PHP_EOL);
});

$appCommands->registerCommand($newCommand);


$goodCommand = new CliCommand();
$goodCommand->setName('Good_Command');
$goodCommand->setDescription('Good command, do something good');
$goodCommand->setCallback(function () {
    print('do good things' . PHP_EOL);
});

$appCommands->registerCommand($goodCommand);


$badCommand = new CliCommand();
$badCommand->setName('Bad_Command');
$badCommand->setDescription('Bad command, do something bad');
$badCommand->setCallback(function () {
    print('do bad things' . PHP_EOL);
});

$appCommands->registerCommand($badCommand);

require_once 'MyCommand.php';

$myCommand = new MyCommand();
$appCommands->registerCommand($myCommand);

$appCommands->run();
