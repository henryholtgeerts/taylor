<?php

namespace Taylor;

class Admin {

    public function init () {
        add_action( 'admin_enqueue_scripts', [ $this, 'loadAssets' ] );
        add_action( 'add_meta_boxes', [ $this, 'setupMetaboxes' ] );
        add_action( 'save_post', [ $this, 'saveMetaboxes' ] );
    }

    public function loadAssets () {
        wp_enqueue_style( 'wp-color-picker' ); 
        wp_enqueue_style( 'taylor-editor-style', get_template_directory_uri() . '/assets/css/editor.css' ); 
        wp_enqueue_script( 'taylor-editor-script', get_template_directory_uri() . '/assets/js/editor.js', [ 'wp-color-picker' ], false, true ); 
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