<?php


namespace Cli;


/**
 * Фасад для работы с командами
 * Class CliFacade
 * @package Cli
 */
class CliFacade
{

    /**
     * хранилище списка команд
     * @var Registry
     */
    private Registry $registry;

    /**
     * CliFacade constructor.
     */
    public function __construct()
    {
        $this->registry = new Registry();

    }

    /**
     * зарегистрировать команду
     * @param AbstractCliCommand $command
     */
    public function registerCommand(AbstractCliCommand $command)
    {
        $this->registry->addCommand($command);
    }

    /**
     * вывести список зарегистрированных команд
     */
    public function listAllCommands()
    {
        foreach ($this->registry->getCommands() as $item) {
            $item->printLn($item->name);
        }
    }

    /**
     * определить текущую команду
     * @return false|mixed
     */
    private function detectCommand()
    {
        global $argv;
        global $argc;

        if ($argc === 1) {
            return false;
        }

        return $argv[1];
    }

    /**
     * запуск команды
     */
    public function run()
    {
        // если текущая команда найдена в зарегистрированных запускаем её
        if ($command = $this->detectCommand()) {
            if (isset($this->registry->getCommands()[$command]) && is_object($this->registry->getCommands()[$command])) {
                $commandClass = $this->registry->getCommands()[$command];
                $commandClass->exec();
            }
        } else {
            // иначе выводим список всех команд
            $this->listAllCommands();
        }
    }
}