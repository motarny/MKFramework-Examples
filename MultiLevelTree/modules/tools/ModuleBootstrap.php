<?php
use MKFramework\Director as Director;
use MKFramework\Config\Config as Config;
use MKFramework\View\View as View;
use MKFramework\Autoloader\Autoloader;

class ModuleBootstrap extends MKFramework\BootstrapAbstract
{

    protected function launchCreateRightToolsMenu()
    {
        $helper = new MKFramework\View\Helper();
        
        $moduleRightMenu = array(
            array(
                'label' => 'Generatory',
                'link' => '',
                'content' => array(
                    array(
                        'label' => 'Generator Persons',
                        'link' => $helper->getUrl(array(
                            'module' => 'tools',
                            'controller' => 'persons',
                            'job' => 'createPersons'
                        ))
                    ),
                    array(
                        'label' => 'Generator Awards',
                        'link' => $helper->getUrl(array(
                            'module' => 'tools',
                            'controller' => 'persons',
                            'job' => 'createAwardsBundle'
                        ))
                    )
                )
            ),
            array(
                'label' => 'Eksport danych',
                'link' => '',
                'content' => array(
                    array(
                        'label' => 'Eksport do CSV',
                        'link' => $helper->getUrl(array(
                            'module' => 'tools',
                            'controller' => 'export',
                            'job' => 'csv'
                        ))
                    ),
                    array(
                        'label' => 'Eksport do XML',
                        'link' => $helper->getUrl(array(
                            'module' => 'tools',
                            'controller' => 'export',
                            'job' => 'xml'
                        ))
                    )
                )
            ),
            array(
                'label' => 'Ustawienia',
                'link' => $helper->getUrl(array(
                    'module' => 'tools',
                    'controller' => 'settings',
                ))
            )
        );
        
        $navigation = \MKFramework\Navigation\Factory::getInstance('ul');
        $navigation->setNavigationElements($moduleRightMenu);
        $navigation->setCssClasses(array(
            'rootUl' => 'rightMenu'
        ));
        
        Director::getLayout()->moduleRightMenu = $navigation->renderNavigation();
    }
}
