<?php


namespace Cli;


abstract class AbstractCliCommand
{
    private string $argRegExp = '/\{(.*)\}/m';
    private string $paramRegExp = '/\[(.*)\]/m';
    private array $argList = [];
    private array $paramList = [];
    public string $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    public string $description;
    public function exec(){}

    /**
     * @return array
     */
    public function getArgList(): array
    {
        return $this->argList;
    }

    /**
     * @return array
     */
    public function getParamList(): array
    {
        return $this->paramList;
    }


    public function parseArgs(): bool
    {
        global $argv;
        global $argc;

        if ($argc === 0) {
            return false;
        }

        $commandName = $argv[1];

        if($commandName !== $this->name)
        {
            return false;
        }

        foreach ($argv as $k => $item) {
            if($k <= 1)
            {
                continue;
            }

            $isParam = preg_match($this->paramRegExp, $item, $paramMatch);

            if($isParam)
            {
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

        return true;
    }

    public function registerCommand()
    {

    }

    public function printLn(string $line)
    {
        print $line.PHP_EOL;
    }
}