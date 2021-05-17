<?php


use Cli\AbstractCliCommand;

/**
 * Class MyCommand
 */
class MyCommand extends AbstractCliCommand
{
    /**
     * дерево аргументов и параметров
     * @var array
     */
    private array $tree;

    /**
     * @var string
     */
    public string $name = 'MyCommand';

    /**
     * @var string
     */
    public string $description = 'Command print all arguments and parameters in tree view';

    /**
     * запустить команду
     */
    public function exec()
    {
        $this->parseArgs();

        foreach ($this->getParamList() as $item) {
            if (mb_strpos($item, '=')) {
                $m = explode('=', $item);

                if (is_array($m) && count($m) > 0) {
                    $this->tree['Options'][$m[0]][] = $m[1];

                }
            } else {
                $this->tree['Options'][] = $item;
            }
        }

        foreach ($this->getArgList() as $item) {
            $this->tree['Arguments'][] = $item;
        }

        $this->printOut();
    }

    /**
     * вывести дерево аргументов и параметров
     */
    public function printOut()
    {
        $this->printLn('Called command: ' . $this->name);

        if (isset($this->tree['Arguments']) && count($this->tree['Arguments']) > 0) {
            $this->printLn('Arguments:');
            foreach ($this->tree['Arguments'] as $k => $value) {
                $this->printLn('   - ' . $value);
            }
        }

        if (isset($this->tree['Options']) && count($this->tree['Options']) > 0) {
            $this->printLn('Options:');
            foreach ($this->tree['Options'] as $k => $value) {
                if (is_array($value)) {
                    $this->printLn('   - ' . $k);
                    foreach ($value as $item) {
                        $this->printLn('      - ' . $item);
                    }
                }
            }
        }
    }
}