<?php

namespace Taylor;

class Admin {

    protected $fonts = [
        'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
        'Open Sans:400italic,700italic,400,700' => 'Open Sans',
        'Oswald:400,700' => 'Oswald',
        'Playfair Display:400,700,400italic' => 'Playfair Display',
        'Montserrat:400,700' => 'Montserrat',
        'Raleway:400,700' => 'Raleway',
        'Droid Sans:400,700' => 'Droid Sans',
        'Lato:400,700,400italic,700italic' => 'Lato',
        'Arvo:400,700,400italic,700italic' => 'Arvo',
        'Lora:400,700,400italic,700italic' => 'Lora',
        'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
        'Oxygen:400,300,700' => 'Oxygen',
        'PT Serif:400,700' => 'PT Serif',
        'PT Sans:400,700,400italic,700italic' => 'PT Sans',
        'PT Sans Narrow:400,700' => 'PT Sans Narrow',
        'Cabin:400,700,400italic' => 'Cabin',
        'Fjalla One:400' => 'Fjalla One',
        'Francois One:400' => 'Francois One',
        'Josefin Sans:400,300,600,700' => 'Josefin Sans',
        'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
        'Arimo:400,700,400italic,700italic' => 'Arimo',
        'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
        'Bitter:400,700,400italic' => 'Bitter',
        'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
        'Roboto:400,400italic,700,700italic' => 'Roboto',
        'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
        'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
        'Roboto Slab:400,700' => 'Roboto Slab',
        'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
        'Rokkitt:400' => 'Rokkitt',
    ];

    public function init () {
        add_action( 'admin_enqueue_scripts', [ $this, 'loadAssets' ] );
        add_action( 'admin_enqueue_scripts', [$this, 'loadGoogleFonts'] );
        add_action( 'admin_enqueue_scripts', [$this, 'loadDynamicStyles'] );
        add_action( 'add_meta_boxes', [ $this, 'setupMetaboxes' ] );
        add_action( 'save_post', [ $this, 'saveMetaboxes' ] );
    }

    public function loadAssets () {
        wp_enqueue_style( 'wp-color-picker' ); 
        wp_enqueue_style( 'taylor-editor-style', get_template_directory_uri() . '/assets/css/editor.css' ); 
        wp_enqueue_script( 'taylor-editor-script', get_template_directory_uri() . '/assets/js/editor.js', [ 'wp-color-picker' ], false, true ); 
    }

    public function loadDynamicStyles() {
        $headingFont = get_theme_mod('taylor_heading_font');
        $bodyFont = get_theme_mod('taylor_body_font');

        $dynamicCss = "
            :root {

                /* Colors */
            
                --primary: #222;
                --primary-light: #333;
                --primary-dark: #111;
                --primary-text: #fff;
            
                --secondary: #eee;
                --secondary-light: #fff;
                --secondary-dark: #ccc;
                --secondary-text: #222;
            
                --accent: cyan;
                --accent-text: purple;
            
            
                /* Typography */
            
                --fontsize: 16px;
                --bodyfont: \"{$this->fonts[$bodyFont]}\";
                --headingfont: \"{$this->fonts[$headingFont]}\";
            
                /* Structure */
            
                --sitewidth: 760px;
                --sitewidth-wide: 1160px;
            }
        ";
        wp_add_inline_style( 'taylor-editor-style', $dynamicCss );
    }

    public function loadGoogleFonts() {
        $headingFont = esc_html( get_theme_mod('taylor_heading_font') );
        $bodyFont = esc_html( get_theme_mod('taylor_body_font') );
    
        if( $headingFont ) {
            wp_enqueue_style( 'taylor-heading-font', '//fonts.googleapis.com/css?family=' . $headingFont . '&display=swap' );
        } else {
            wp_enqueue_style( 'taylor-body-font', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,700,600&display=swap');
        }
        if( $bodyFont ) {
            wp_enqueue_style( 'taylor-body-font', '//fonts.googleapis.com/css?family=' . $bodyFont . '&display=swap' );
        } else {
            wp_enqueue_style( 'taylor-body-font', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,700,600&display=swap');
        }
    }

    public function setupMetaBoxes () {
        add_meta_box(
            'taylor-post',
            __( 'Appearance', 'textdomain' ),
            [ $this, 'outputMetaboxes'],
            'page',
            'side'
        );
    }

    public function outputMetaboxes ( $post ) {
        include_once( get_stylesheet_directory() . '/inc/views/metaboxes.php' );
    }

    public function saveMetaboxes ( $postId ) {
        // Checks save status - overcome autosave, etc.
        $isAutosave = wp_is_post_autosave( $postId );
        $isRevision = wp_is_post_revision( $postId );
        $isValidNonce = ( isset( $_POST[ 'taylor_metabox_nonce' ] ) && wp_verify_nonce( $_POST[ 'taylor_metabox_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $isAutosave || $isRevision || !$isValidNonce ) {
            return;
        }

        if( isset( $_POST[ 'taylor_use_transparent_header' ] ) ) {
            update_post_meta( $postId, 'taylor_use_transparent_header', 'true' );
        } else {
            update_post_meta( $postId, 'taylor_use_transparent_header', 'false' );
        }

        if( isset( $_POST[ 'taylor_hide_title' ] ) ) {
            update_post_meta( $postId, 'taylor_hide_title', 'true' );
        } else {
            update_post_meta( $postId, 'taylor_hide_title', 'false' );
        }

        if( isset( $_POST[ 'taylor_use_transparent_header' ] ) ) {
            update_post_meta( $postId, 'taylor_use_transparent_header', 'true' );
        } else {
            update_post_meta( $postId, 'taylor_use_transparent_header', 'false' );
        }

        if( isset( $_POST[ 'taylor_hide_title' ] ) ) {
            update_post_meta( $postId, 'taylor_hide_title', 'true' );
        } else {
            update_post_meta( $postId, 'taylor_hide_title', 'false' );
        }

        if( isset( $_POST[ 'taylor_remove_top_spacing' ] ) ) {
            update_post_meta( $postId, 'taylor_remove_top_spacing', 'true' );
        } else {
            update_post_meta( $postId, 'taylor_remove_top_spacing', 'false' );
        }

        if( isset( $_POST[ 'taylor_remove_bottom_spacing' ] ) ) {
            update_post_meta( $postId, 'taylor_remove_bottom_spacing', 'true' );
        } else {
            update_post_meta( $postId, 'taylor_remove_bottom_spacing', 'false' );
        }

        if( isset( $_POST[ 'taylor_header_primary_color' ] ) && !empty( $_POST[ 'taylor_header_primary_color' ] ) ) {
            update_post_meta( $postId, 'taylor_header_primary_color', $_POST[ 'taylor_header_primary_color' ] );
        } else {
            update_post_meta( $postId, 'taylor_header_primary_color', '#222' );
        }

        if( isset( $_POST[ 'taylor_header_secondary_color' ] ) && !empty( $_POST[ 'taylor_header_secondary_color' ] ) ) {
            update_post_meta( $postId, 'taylor_header_secondary_color', $_POST[ 'taylor_header_secondary_color' ] );
        } else {
            update_post_meta( $postId, 'taylor_header_secondary_color', '#eee' );
        }
    }

}