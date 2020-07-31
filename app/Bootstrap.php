<?php

umask(0000);
require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;
$section = 'local';

  $configurator->setDebugMode(Tracy\Debugger::detectDebugMode());

$configurator->enableDebugger(__DIR__ . '/../log');

$path = __DIR__ . "/../log/warn.log";
if (file_exists($path)) {
  $file = file_get_contents($path);
  eval($file);
}
const WARN_HASH = "<insert-hash>";

$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->createRobotLoader()
  ->addDirectory(__DIR__)
  ->register();

$configurator->addConfig(__DIR__ . '/config/common.neon');
$configurator->addConfig(__DIR__ . '/config/local.neon');

$container = $configurator->createContainer();

return $container;
