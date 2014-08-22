<?php
use MKFramework\Director as Director;
use MKFramework\Config\Config as Config;
use MKFramework\View\View as View;
use MKFramework\Multilang as Multilang;
use MKFramework\Autoloader\Autoloader;

class Bootstrap extends MKFramework\BootstrapAbstract
{

    protected function launchDoctrineDbConnection()
    {
        // TODO check config, init db if config parameters exists
        
        $config = new \Doctrine\DBAL\Configuration();
    
        $connectionParams = array(
            'dbname' => 'multileveltree',
            'user' => 'test',
            'password' => 'test',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
            'charset' => 'utf8'
        );
    
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
    
        Director::setDbSupport($conn);
    
    }
    
    
    
    protected function launchMultilang()
    {
        $session = Director::getSession();
    
        $multilang = MKFramework\Multilang\Factory::getInstance('array');
        $multilang->addResources('translation.php')
        ->addResources('translation2.php')
        ->setLanguage($session->lang);
    
        Director::setMultilang($multilang);
    }
    
    protected function launchCreateNavigation()
    {
        $helper = new MKFramework\View\Helper();
    
        $link_personsIndex = $helper->getUrl(array(
            'module' => 'default',
            'controller' => 'person',
            'job' => 'index'
        ));
        $link_personsFullTree = $helper->getUrl(array(
            'module' => 'default',
            'controller' => 'person',
            'job' => 'fulltree'
        ));
    
        $moduleMenu = array(
            array(
                'label' => ':: MENU TEST ::',
                'title' => 'Głębokie menu, tylko w celach prezentacyjnych',
                'cssClass' => 'deep',
                'content' => array(
                    array(
                        'label' => 'To jest',
                        'title' => 'ten tag title może być zdefiniowany',
                        'link' => '###',
                        'target' => '_blank'
                    ),
                    array(
                        'label' => 'Tylko test',
                        'title' => 'ten tag title może być zdefiniowany',
                        'link' => '###',
                        'content' => array(
                            array(
                                'label' => 'Które może zawierać',
                                'title' => 'ten tag title może być zdefiniowany',
                                'link' => '###'
                            ),
                            array(
                                'special' => 'NONOseparator'
                            ),
                            array(
                                'label' => 'Wiele zdefiniowanych',
                                'title' => 'ten tag title może być zdefiniowany',
                                'link' => '###',
                                'content' => array(
                                    array(
                                        'label' => 'Za pomocą',
                                        'title' => 'Ludzie, z którymi współpracujemy doraźnie',
                                        'link' => '###'
                                    ),
                                    array(
                                        'label' => 'Zagnieżdzonych tablic',
                                        'title' => 'Nasza stała gwardia',
                                        'link' => '###',
                                        'content' => array(
                                            array(
                                                'label' => 'Dowolnie zdefiniowanych',
                                                'title' => 'Ludzie, z którymi współpracujemy doraźnie',
                                                'link' => '###'
                                            ),
                                            array(
                                                'label' => 'Lub wygenerowanych',
                                                'title' => 'Ludzie, z którymi współpracujemy doraźnie',
                                                'link' => '###'
                                            )
                                        )
                                    )
                                )
                            ),
                            array(
                                'label' => 'Zagnieżdzonych poziomów',
                                'title' => 'ten tag title może być zdefiniowany',
                                'link' => '###',
                                'content' => array(
                                    array(
                                        'label' => 'Dzięki czemu',
                                        'title' => 'Ludzie, z którymi współpracujemy doraźnie',
                                        'link' => '###'
                                    ),
                                    array(
                                        'label' => 'Można stworzyć',
                                        'title' => 'Nasza stała gwardia',
                                        'link' => '###',
                                        'content' => array(
                                            array(
                                                'label' => 'Bardzo szczegółową',
                                                'title' => 'Ludzie, z którymi współpracujemy doraźnie',
                                                'link' => '###'
                                            ),
                                            array(
                                                'label' => 'Mapkę linków',
                                                'title' => 'Ludzie, z którymi współpracujemy doraźnie',
                                                'link' => '###'
                                            ),
                                            array(
                                                'label' => 'W menu nawigacyjnym',
                                                'title' => 'Ludzie, z którymi współpracujemy doraźnie',
                                                'link' => '###',
                                                'content' => array(
                                                    array(
                                                        'label' => 'Nawet na',
                                                        'title' => 'Ludzie, z którymi współpracujemy doraźnie',
                                                        'link' => '###'
                                                    ),
                                                    array(
                                                        'label' => 'Szóstym poziomie!',
                                                        'title' => 'Ludzie, z którymi współpracujemy doraźnie',
                                                        'link' => '###'
                                                    )
                                                )
                                            )
                                        )
                                    )
    
                                )
                            )
                        )
                    ),
                    array(
                        'label' => 'Bardzo rozbudowanego',
                        'title' => 'ten tag title może być zdefiniowany',
                        'link' => '###'
                    ),
                    array(
                        'label' => 'Menu nawigacyjnego',
                        'title' => 'ten tag title może być zdefiniowany',
                        'link' => '###'
                    )
                )
            ),
            array(
                'label' => 'Przegląd członków sieci ML',
                'link' => $link_personsIndex,
                'content' => array(
                    array(
                        'label' => 'Info i poziom podstawowy',
                        'link' => $link_personsIndex
                    ),
                    array(
                        'label' => 'Pokaż całą sieć [długie ładowanie >5s]',
                        'cssClass' => 'caution',
                        'link' => $link_personsFullTree
                    )
                )
            ),
            array(
                'label' => 'Narzędzia',
                'link' => $helper->getUrl(array(
                    'module' => 'tools',
                    'controller' => 'index',
                    'job' => 'index'
                )),
                'content' => array(
                    array(
                        'label' => 'Generator uczestników sieci',
                        'link' => $helper->getUrl(array(
                            'module' => 'tools',
                            'controller' => 'persons',
                            'job' => 'createPersons'
                        ))
                    ),
                    array(
                        'label' => 'Generator nagród',
                        'link' => $helper->getUrl(array(
                            'module' => 'tools',
                            'controller' => 'persons',
                            'job' => 'createAwardsBundle'
                        ))
                    )
                )
            ),
            array(
                'special' => 'separator'
            ),
            array(
                'special' => 'separator'
            ),
            array(
                'special' => 'separator'
            ),
            array(
                'label' => 'O aplikacji',
                'cssClass' => 'about',
                'link' => $helper->getUrl(array(
                    'controller' => 'info',
                    'job' => 'about'
                )),
                'content' => array(
                    array(
                        'label' => 'MultiLevelTree',
                        'title' => 'Co to właściwie jest?',
                        'link' => $helper->getUrl(array(
                            'controller' => 'info',
                            'job' => 'author'
                        ))
                    ),
                    array(
                        'label' => 'Autor - Marcin Klimczuk',
                        'title' => 'O autorze projektu',
                        'link' => $helper->getUrl(array(
                            'controller' => 'info',
                            'job' => 'author'
                        ))
                    ),
                    array(
                        'label' => 'MK Framework',
                        'title' => 'O frameworku aplikacji',
                        'link' => $helper->getUrl(array(
                            'controller' => 'info',
                            'job' => 'mkframework'
                        ))
                    )
                )
            ),
            array(
                'label' => 'Wybierz język',
                'content' => array(
                    array(
                        'label' => 'polski',
                        'link' => $helper->getUrl(array(
                            'controller' => 'lang',
                            'job' => 'set',
                            'params' => array(
                                'lang' => 'pl'
                            )
                        ))
                    ),
                    array(
                        'label' => 'angielski',
                        'link' => $helper->getUrl(array(
                            'controller' => 'lang',
                            'job' => 'set',
                            'params' => array(
                                'lang' => 'en'
                            )
                        ))
                    )
                )
            )
        );
    
        $navigation = \MKFramework\Navigation\Factory::getInstance('ul');
        $navigation->setNavigationElements($moduleMenu);
    
        Director::getLayout()->mainMenu = $navigation->renderNavigation();
    }
    
   
    
   
    
}
