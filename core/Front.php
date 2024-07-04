<?php

namespace MXP\MITypes;

use MXP\MITypes\Base\Singleton;

final class Front extends Singleton {

    public function init(){
        $app = App::instance();
        require_once $app->getDirectoryPath() . 'mitypes/renders/renders.php' ;
    }
}