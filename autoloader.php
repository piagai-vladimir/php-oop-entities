<?php

use Core\Autoloader;

require_once __DIR__ . "/Core/Autoloader.php";

$autoloader = new Autoloader();
$autoloader->addNamespace('AgroManager', __DIR__.'/src/AgroManager');
$autoloader->register();
