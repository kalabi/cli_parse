<?php


namespace Cli;


/**
 * Class CliCommand
 * @package Cli
 */
class CliCommand extends AbstractCliCommand
{
    /**
     * @var string
     */
    public string $name;
    /**
     * @var string
     */
    public string $description;
    /**
     * @var
     */
    public $callback;

    /**
     * @param $callback
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
    }

    /**
     * запустить команду
     */
    public function exec()
    {
        $this->parseArgs();
        call_user_func($this->callback);
    }

}