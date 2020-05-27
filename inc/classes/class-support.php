<?php

namespace Taylor;

class Support {

    protected $supports = [
        'title-tag',
        'align-wide',
        'responsive-embeds'
    ];

    public function init () {
        add_action( 'after_setup_theme', [ $this, 'setupSupport' ] );
    }

    public function setupSupport () {
        foreach ($this->supports as $support) {
            add_theme_support( $support ); 
        }
    }
}

?>