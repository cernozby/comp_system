<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../app/Bootstrap.php';

$container->getByType('Nette\Application\Application')->run();
