<?php

namespace Taylor;

class Frontend {

    public function init () {
        add_action( 'wp_enqueue_scripts', [$this, 'loadAssets'] );
    }

    public function loadAssets () {
        $theme_version = wp_get_theme()->get( 'Version' );
        wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/css/normalize.css', [], '8.1.0' );
        wp_enqueue_style( 'taylor', get_stylesheet_uri(), ['normalize'], $theme_version );
    }
}