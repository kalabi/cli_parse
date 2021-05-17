<?php


namespace Cli;


/**
 * Интерфейс команды
 * Class AbstractCliCommand
 * @package Cli
 */
abstract class AbstractCliCommand
{
    /**
     * регулярка для аргументов
     * @var string
     */
    private string $argRegExp = '/\{(.*)\}/m';

    /**
     * регулярка для параметров
     * @var string
     */
    private string $paramRegExp = '/\[(.*)\]/m';


    /**
     * список аргументов
     * @var array
     */
    private array $argList = [];

    /**
     * список параметров
     * @var array
     */
    private array $paramList = [];

    /**
     * название команды
     * @var string
     */
    public string $name;

    /**
     * описание команды
     * @var string
     */
    public string $description;


    /**
     * получить список аргуметов
     * @return array
     */
    public function getArgList(): array
    {
        return $this->argList;
    }

    /**
     * получить список параметров
     * @return array
     */
    public function getParamList(): array
    {
        return $this->paramList;
    }

    /**
     * полуить название команды
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * установить название команды
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * получить описание команды
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * установить описание команды
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * распарсить список аргументов и параметров
     * @return bool
     */
    public function parseArgs(): bool
    {
        global $argv;
        global $argc;

        if ($argc === 1) {
            return false;
        }

        $commandName = $argv[1];

        if ($commandName !== $this->name) {
            return false;
        }

        foreach ($argv as $k => $item) {
            if ($k <= 1) {
                continue;
            }

            $isParam = preg_match($this->paramRegExp, $item, $paramMatch);

            if ($isParam) {
                $this->paramList[] = $paramMatch[1];
            } else {

                $isArg = preg_match($this->argRegExp, $item, $argMatch);

                if ($isArg) {
                    $this->argList[] = $argMatch[1];
                } else {
                    $this->argList[] = $item;
                }
            }
        }

        $this->checkHelp();

        return true;
    }

    /**
     * проверить передан ли аргумент help
     */
    protected function checkHelp()
    {
        foreach ($this->argList as $item) {
            if ($item === 'help') {
                $this->printLn($this->description);
            }
        }
    }

    /**
     * вывести строку в консоль
     * @param string $line
     */
    public function printLn(string $line)
    {
        print $line . PHP_EOL;
    }

    public function exec()
    {
    }
}