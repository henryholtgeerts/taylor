<?php

namespace Taylor;

use Taylor\Admin;
use Taylor\Frontend;
use Taylor\Menus;
use Taylor\Support;

class Bootstrapper {

    public function init () {

        $this->setupMenus();
        $this->setupSupport();

        if ( is_admin() ) {
            $this->setupAdmin();
        } else {
            $this->setupFrontend();
        }
        
    }

    protected function setupAdmin () {
        include_once( get_stylesheet_directory() . '/inc/classes/class-admin.php' );
        (new Admin)->init();
    }

    protected function setupFrontend () {
        include_once( get_stylesheet_directory() . '/inc/classes/class-frontend.php' );
        (new Frontend)->init();
    }

    protected function setupMenus () {
        include_once( get_stylesheet_directory() . '/inc/classes/class-menus.php' );
        (new Menus)->init();
    }

    protected function setupSupport () {
        include_once( get_stylesheet_directory() . '/inc/classes/class-support.php' );
        (new Support)->init();
    }

}