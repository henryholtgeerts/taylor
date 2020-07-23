<?php

namespace Taylor;

class Frontend {

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
        add_action( 'wp_enqueue_scripts', [$this, 'loadAssets'] );
        add_action( 'wp_enqueue_scripts', [$this, 'loadGoogleFonts'] );
        add_action( 'wp_enqueue_scripts', [$this, 'loadDynamicStyles'] );
        add_filter( 'style_loader_tag', [$this, 'preloadStylesheets'], 10, 4 );
    }

    public function loadAssets () {
        $theme_version = wp_get_theme()->get( 'Version' );
        wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/css/normalize.css', [], '8.1.0' );
        wp_enqueue_style( 'taylor', get_stylesheet_uri(), ['normalize'], $theme_version );
    }

    public function loadDynamicStyles() {
        $headingFont = esc_html( get_theme_mod('taylor_heading_font') );
        $bodyFont = esc_html( get_theme_mod('taylor_body_font') );
        $primaryMenuFont = esc_html( get_theme_mod('taylor_primary_menu_font') );
        $nameFont = esc_html( get_theme_mod('taylor_branding_name_font') );
        $taglineFont = esc_html( get_theme_mod('taylor_branding_tagline_font') );

        $bodyFontSize = esc_html( get_theme_mod('taylor_body_font_size') );
        $siteNameFontSize = esc_html( get_theme_mod('taylor_branding_name_font_size') );
        $h1FontSize = esc_html( get_theme_mod('taylor_h1_font_size') );
        $h2FontSize = esc_html( get_theme_mod('taylor_h2_font_size') );
        $h3FontSize = esc_html( get_theme_mod('taylor_h3_font_size') );
        $h4FontSize = esc_html( get_theme_mod('taylor_h4_font_size') );
        $h5FontSize = esc_html( get_theme_mod('taylor_h5_font_size') );
        $h6FontSize = esc_html( get_theme_mod('taylor_h6_font_size') );

        $headerBackgroundColor = esc_html( get_theme_mod('taylor_header_background_color') );
        $headerPrimaryColor = esc_html( get_theme_mod('taylor_header_primary_color') );

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

                --headerprimarycolor: {$headerPrimaryColor};
                --headerbackgroundcolor: {$headerBackgroundColor};
            
                /* Typography */
            
                --bodyfont: \"{$this->fonts[$bodyFont]}\";
                --headingfont: \"{$this->fonts[$headingFont]}\";
                --primarymenufont: \"{$this->fonts[$primaryMenuFont]}\";
                --sitenamefont: \"{$this->fonts[$nameFont]}\";
                --sitetaglinefont: \"{$this->fonts[$taglineFont]}\";

                --fontsize: {$bodyFontSize};
                --sitenamefontsize: {$siteNameFontSize};
                --h1fontsize: {$h1FontSize};
                --h2fontsize: {$h2FontSize};
                --h3fontsize: {$h3FontSize};
                --h4fontsize: {$h4FontSize};
                --h5fontsize: {$h5FontSize};
                --h6fontsize: {$h6FontSize};

                /* Structure */
            
                --sitewidth: 760px;
                --sitewidth-wide: 1160px;
            }
        ";
        wp_add_inline_style( 'taylor', $dynamicCss );
    }

    public function loadGoogleFonts() {

        $headingFont = esc_html( get_theme_mod('taylor_heading_font') );
        $bodyFont = esc_html( get_theme_mod('taylor_body_font') );
        $primaryMenuFont = get_theme_mod('taylor_primary_menu_font');
        $nameFont = get_theme_mod('taylor_branding_name_font');
        $taglineFont = get_theme_mod('taylor_branding_tagline_font');

        $fontFamilies = [
            esc_html( get_theme_mod('taylor_heading_font') ),
            esc_html( get_theme_mod('taylor_body_font') ),
            esc_html( get_theme_mod('taylor_primary_menu_font') ),
            esc_html( get_theme_mod('taylor_branding_name_font') ),
            esc_html(  get_theme_mod('taylor_branding_tagline_font') ),
        ];

        $includeDefaultFamily = false;

        $uniqueFonts = array_unique( $fontFamilies );

        foreach ( $uniqueFonts as $fontFamily ) {
            if ( empty( $fontFamily ) ) {
                $includeDefaultFamily = true;
            } else {
                $handle = 'taylor-' . $this->sluggify($this->fonts[$fontFamily]);
                wp_enqueue_style( $handle, '//fonts.googleapis.com/css?family=' . $fontFamily . '&display=swap' );
            }
        }

        if ( $includeDefaultFamily === true ) {
            wp_enqueue_style( 'taylor-default-font', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,700,600&display=swap');
        }
    }

    public function preloadStylesheets ($html, $handle, $href, $media) {
        if ( strpos($handle, 'taylor') !== false ) {
            $html = "<link rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\" id='{$handle}' href='{$href}' type='text/css' media='all' />";
        }
        return $html;
    }

    protected function sluggify($string, $separator = '-', $maxLength = 96) {
        $title = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $title = preg_replace("%[^-/+|\w ]%", '', $title);
        $title = strtolower(trim(substr($title, 0, $maxLength), '-'));
        $title = preg_replace("/[\/_|+ -]+/", $separator, $title);

        return $title;
    }
}