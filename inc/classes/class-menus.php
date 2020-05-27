<?php

namespace Taylor;

class Menus {
    protected $locations = [
        'primary' => 'Desktop Horizontal Menu',
    ];

    public function init () {
        add_action( 'init', [ $this, 'setupMenus' ] );
    }

    public function setupMenus () {
        register_nav_menus( $this->locations );
    }
}