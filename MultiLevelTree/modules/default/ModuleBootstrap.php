<?php
use MKFramework\Director as Director;
use MKFramework\Config\Config as Config;
use MKFramework\View\View as View;
use MKFramework\Autoloader\Autoloader;

class ModuleBootstrap extends MKFramework\BootstrapAbstract
{

    protected function launchMultilang()
    {
        $multilang = MKFramework\Multilang\Factory::getInstance('array');
        $multilang->addResources('translation.php')->addResources('translation2.php')->setLanguage('esp');
    
        Director::setMultilang($multilang);
    }
    
    
    protected function launchCreateNavigation()
    {
        $moduleMenu = array(
            array(
                'label' => 'O firmie',
                'title' => 'Dowiedz się wiecej o naszej firmie',
                'cssClass' => 'mainCompany',
                'content' => array(
                    array(
                        'label' => 'Historia firmy',
                        'title' => 'Długie wywody o tym skąd jesteśmy',
                        'link' => '###',
                        'target' => '_blank'
                    ),
                    array(
                        'label' => 'Pracownicy spółki',
                        'title' => 'Nasza zwariowana ekipa',
                        'link' => '###',
                        'content' => array(
                            array(
                                'label' => 'Prezes i zarząd',
                                'title' => 'O naszym prezesie!',
                                'link' => '###'
                            ),
                            array(
                                'special' => 'separator'
                            ),
                            array(
                                'label' => 'Dział księgowości',
                                'title' => 'Miłe panie, które trzymają papiery',
                                'link' => '###'
                            ),
                            array(
                                'label' => 'Nasi graficy',
                                'title' => 'Szalona drużyna naszych artystów',
                                'link' => '###',
                                'content' => array(
                                    array(
                                        'label' => 'Freelancerzy',
                                        'title' => 'Ludzie, z którymi współpracujemy doraźnie',
                                        'link' => '###'
                                    ),
                                    array(
                                        'label' => 'Pracownicy etatowi',
                                        'title' => 'Nasza stała gwardia',
                                        'link' => '###'
                                    )
                                )
                            )
                        )
                    ),
                    array(
                        'label' => 'Nasi partnerzy',
                        'title' => 'Z jakimi firmami współpracujemy',
                        'link' => '###'
                    )
                )
            ),
            array(
                'label' => 'Galeria zdjęć',
                'title' => 'zobacz nas w obiektywie'
            ),
            array(
                'special' => 'separator'
            ),
            array(
                'label' => 'Mapka dojazdu',
                'title' => 'Zobacz gdzie jestesmy i jak dojechać',
                'cssClass' => 'map'
            ),
            array(
                'label' => 'Formularz kontaktowy',
                'title' => 'Skontaktuj się z nami',
                'cssClass' => 'contact'
            )
        );
        
        $navigation = \MKFramework\Navigation\Factory::getInstance('ul');
        $navigation->setNavigationElements($moduleMenu);
        
        Director::getLayout()->mainMenu = $navigation->renderNavigation();
    }
    
    
    
    
}
