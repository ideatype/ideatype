<?php

use Service\ConfigManager\Application\Service\ConfigManagerService;

require 'bootstrap.php';

/** @var ConfigManagerService $managerAPI */
$managerAPI = $container->get(ConfigManagerService::class);
print_r($managerAPI->getConfig("menu"));
