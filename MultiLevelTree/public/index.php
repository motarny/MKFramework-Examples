<?php
use MKFramework\Registry\Registry;
use Doctrine\Common\ClassLoader;

$configFile = 'config/app.ini';
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../'));
defined('DOCUMENT_ROOT') || define('DOCUMENT_ROOT', dirname($_SERVER['PHP_SELF']));

require_once 'Launcher.php';

MKFramework\Launcher::launchFrameworkApplication($configFile);

