<?php


namespace Cli;


/**
 * Хранилище списка команд
 * Class Registry
 * @package Cli
 */
class Registry
{
    /**
     * @var array
     */
    private array $commands = [];

    /**
     * Получить список команд
     * @return array
     */
    public function getCommands(): array
    {
        return $this->commands;
    }

    /**
     * Добавить команду в хранилище
     * @param CliCommand $command
     */
    public function addCommand(AbstractCliCommand $command): void
    {
        $this->commands[$command->getName()] = $command;
    }
}