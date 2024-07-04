<?php

namespace MXP\MITypes;

use MXP\MITypes\Base\Singleton;

final class Admin extends Singleton {


    public function init(){
        $app = App::instance();
        require_once $app->getDirectoryPath() . 'admin/acf-location/acf-mitypes-locations.php' ;
        require_once $app->getDirectoryPath() . 'admin/nav_menu.php' ;
        require_once $app->getDirectoryPath() . 'admin/metabox/mitypes-menu-item-types.php' ;
    }
}