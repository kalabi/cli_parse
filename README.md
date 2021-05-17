### Библиотека для парсинга ключей запуска cli-скрипта

1. Подключение библиотеки через автолоад composer

```
require 'vendor/autoload.php';
```

2. Создать объект фасад для работы с командами

```
$appCommands = new CliFacade();
```

3. Создать объект команды и зарегистрировать его

```
$newCommand = new CliCommand();
$newCommand->setName('Test_Command');
$newCommand->setDescription('Test command, do nothing');
$newCommand->setCallback(function () {
    print('do nothing' . PHP_EOL);
});

$appCommands->registerCommand($newCommand);
```

4. Можно вынести команду в отдельный класс, подключить его и так же зарегистрировать

```
class MyCommand extends AbstractCliCommand
{
...
}

require_once 'MyCommand.php';

$myCommand = new MyCommand();
$appCommands->registerCommand($myCommand);
```

5. Можно использовать парсинг аргументов отдельно, без регистрации команды
```
$appCommands->parse()
```