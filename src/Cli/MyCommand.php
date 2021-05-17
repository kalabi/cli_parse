<?php


namespace Cli;


class MyCommand extends AbstractCliCommand
{
    private array $tree;
    public string $name = 'MyCommand';
    public string $description = 'Command print all arguments and parameters in tree view';

    public function exec()
    {
       if(!$this->parseArgs())
       {
            $this->printLn('Unknown command');
            return false;
       }


        foreach ($this->getParamList() as $item) {
            if(mb_strpos($item, '='))
            {
                $m = explode('=', $item);

                if(is_array($m) && count($m) > 0)
                {
                    $this->tree['Options'][$m[0]][] = $m[1];

                }
            }
            else {
                $this->tree['Options'][] = $item;
            }
       }

        foreach ($this->getArgList() as $item) {
            $this->tree['Arguments'][] = $item;
        }

        $this->printOut();
    }

    public function printOut()
    {
        $this->printLn('Called command: '.$this->name);
        $this->printLn('Arguments:');
        foreach ($this->tree['Arguments'] as $k => $value) {
            $this->printLn('   - '.$value);
        }

        $this->printLn('Options:');
        foreach ($this->tree['Options'] as $k => $value) {
            if(is_array($value))
            {
                $this->printLn('   - '.$k);
                foreach ($value as $item) {
                    $this->printLn('      - '.$item);
                }
            }
//            $this->printLn('    - '.$value);
        }
    }
}