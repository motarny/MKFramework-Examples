<?php
use MKFramework\Director as Director;
use MKFramework\Config\Config as Config;
use MKFramework\View\View as View;
use MKFramework\Autoloader\Autoloader;

class Bootstrap extends MKFramework\BootstrapAbstract
{



    protected function initDoctrineDbConnection()
    {
        $config = new \Doctrine\DBAL\Configuration();
    
        $connectionParams = array(
            'dbname' => 'testing',
            'user' => 'test',
            'password' => 'test',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
            'charset' => 'utf8'
        );
    
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
    
        Director::setDbSupport($conn);
    
    }
    
}
