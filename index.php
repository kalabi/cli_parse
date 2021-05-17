<?php

use Cli\MyCommand;

require 'vendor/autoload.php';

$cli = new MyCommand();
$cli->exec();
