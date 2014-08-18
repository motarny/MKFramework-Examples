<?php
use MKFramework\Registry\Registry;
use Doctrine\Common\ClassLoader;

$configFile = 'config/app.ini';
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../'));

require_once 'Launcher.php';

MKFramework\Launcher::launchFrameworkApplication($configFile);




?>