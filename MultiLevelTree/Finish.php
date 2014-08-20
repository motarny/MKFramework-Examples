<?php
$multilang = \MKFramework\Director::getMultilang();
if (! empty($multilang)) {
    
    
    echo "-----------------<BR>";
    echo "Finish.php<BR>";    
    echo "-----------------<BR>";
    echo "Brakujące tłumaczenia<BR><BR>";
    
    print_r(\MKFramework\Director::getMultilang()->getMissedTranslations());
}

?>