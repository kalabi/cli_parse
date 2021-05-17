<?php


namespace Cli;


class Registry
{
    private array $commands = [];

    /**
     * @return array
     */
    public function getCommands(): array
    {
        return $this->commands;
    }

    /**
     * @param CliCommand $command
     */
    public function setCommands(CliCommand $command): void
    {
        $this->commands[] = $command;
    }


}