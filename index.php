<?php
require_once(__DIR__.'/Configuration/Config.php');
require_once(__DIR__.'/Configuration/Autoload.php');
Autoload::charger();

$cont = new FrontController();
