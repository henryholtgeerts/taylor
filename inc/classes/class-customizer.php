<?php

namespace Taylor;

class Customizer {

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
        add_action('customize_register', [ $this, 'setupCustomizer' ]);
    }

    public function setupCustomizer ( $wp_customize ) {

        // Site identity

        $wp_customize->add_setting( 'taylor_tagline_display', [
            'capability' => 'edit_theme_options',
            'sanitize_callback' => [$this, 'sanitizeTaglineDisplay'],
            'default' => 'hidden',
        ] );

        $wp_customize->add_control( 'taylor_tagline_display', [
            'type' => 'select',
            'section' => 'title_tagline', // Add a default or your own section
            'label' => __( 'Tagline Display' ),
            'description' => __( 'How to display the site tagline' ),
            'choices' => [
                'hidden' => 'Hidden',
                'stacked' => 'Stacked',
                'inline' => 'Inline'
            ]
        ] );

        // Colors

        $wp_customize->add_panel( 'taylor_colors', [
            'title' => __( 'Colors' ),
            'description' => 'Custom theme colors', // Include html tags such as <p>.
            'priority' => 60, // Mixed with top-level-section hierarchy.
        ] );

        $wp_customize->add_section( 'taylor_header_colors', [
            'title' => __( 'Header' ),
            'description' => __( 'Custom header colors' ),
            'panel' => 'taylor_colors', // Not typically needed.
            'priority' => 160,
            'capability' => 'edit_theme_options',
            'theme_supports' => '', // Rarely needed.
        ] );

        $wp_customize->add_setting( 'taylor_header_primary_color', [
            'capability' => 'edit_theme_options',
            'default' => '#fff',
        ] );

        $wp_customize->add_control( 
            new \WP_Customize_Color_Control( 
            $wp_customize, 
            'taylor_header_primary_color', 
            [
                'label'      => __( 'Header Primary Color' ),
                'section'    => 'taylor_header_colors',
                'settings'   => 'taylor_header_primary_color',
            ] ) 
        );

        $wp_customize->add_setting( 'taylor_header_background_color', [
            'capability' => 'edit_theme_options',
            'default' => '#222',
        ] );

        $wp_customize->add_control( 
            new \WP_Customize_Color_Control( 
            $wp_customize, 
            'taylor_header_background_color', 
            [
                'label'      => __( 'Header Background Color' ),
                'section'    => 'taylor_header_colors',
                'settings'   => 'taylor_header_background_color',
            ] ) 
        );

        // Content Colors

        $wp_customize->add_section( 'taylor_content_colors', [
            'title' => __( 'Content' ),
            'description' => __( 'Custom content colors' ),
            'panel' => 'taylor_colors', // Not typically needed.
            'priority' => 160,
            'capability' => 'edit_theme_options',
            'theme_supports' => '', // Rarely needed.
        ] );

        $wp_customize->add_setting( 'taylor_content_primary_color', [
            'capability' => 'edit_theme_options',
            'sanitize_callback' => [$this, 'sanitizeFont'],
            'default' => '#ccc',
        ] );

        $wp_customize->add_control( 
            new \WP_Customize_Color_Control( 
            $wp_customize, 
            'taylor_content_primary_color', 
            [
                'label'      => __( 'Content Primary Color' ),
                'section'    => 'taylor_content_colors',
                'settings'   => 'taylor_content_primary_color',
            ] ) 
        );

        $wp_customize->add_setting( 'taylor_content_background_color', [
            'capability' => 'edit_theme_options',
            'sanitize_callback' => [$this, 'sanitizeFont'],
            'default' => '#ccc',
        ] );

        $wp_customize->add_control( 
            new \WP_Customize_Color_Control( 
            $wp_customize, 
            'taylor_content_background_color', 
            [
                'label'      => __( 'Content Background Color' ),
                'section'    => 'taylor_content_colors',
                'settings'   => 'taylor_content_background_color',
            ] ) 
        );

        $wp_customize->add_setting( 'taylor_content_accent_color', [
            'capability' => 'edit_theme_options',
            'sanitize_callback' => [$this, 'sanitizeFont'],
            'default' => '#ccc',
        ] );

        $wp_customize->add_control( 
            new \WP_Customize_Color_Control( 
            $wp_customize, 
            'taylor_content_accent_color', 
            [
                'label'      => __( 'Content Accent Color' ),
                'section'    => 'taylor_content_colors',
                'settings'   => 'taylor_content_accent_color',
            ] ) 
        );

        $wp_customize->add_section( 'taylor_footer_colors', [
            'title' => __( 'Footer' ),
            'description' => __( 'Custom footer colors' ),
            'panel' => 'taylor_colors', // Not typically needed.
            'priority' => 160,
            'capability' => 'edit_theme_options',
            'theme_supports' => '', // Rarely needed.
        ] );

        $wp_customize->add_setting( 'taylor_footer_primary_color', [
            'capability' => 'edit_theme_options',
            'sanitize_callback' => [$this, 'sanitizeFont'],
            'default' => '#ccc',
        ] );

        $wp_customize->add_control( 
            new \WP_Customize_Color_Control( 
            $wp_customize, 
            'taylor_footer_primary_color',
            [
                'label'      => __( 'Footer Primary Color' ),
                'section'    => 'taylor_footer_colors',
                'settings'   => 'taylor_footer_primary_color',
            ] ) 
        );

        $wp_customize->add_setting( 'taylor_footer_background_color', [
            'capability' => 'edit_theme_options',
            'sanitize_callback' => [$this, 'sanitizeFont'],
            'default' => '#ccc',
        ] );

        $wp_customize->add_control( 
            new \WP_Customize_Color_Control( 
            $wp_customize, 
            'taylor_footer_background_color',
            [
                'label'      => __( 'Footer Background Color' ),
                'section'    => 'taylor_footer_colors',
                'settings'   => 'taylor_footer_background_color',
            ] ) 
        );

        // Typography

        $wp_customize->add_panel( 'taylor_typography', [
            'title' => __( 'Typography' ),
            'description' => 'Custom font styles', // Include html tags such as <p>.
            'priority' => 60, // Mixed with top-level-section hierarchy.
        ] );

        $wp_customize->add_section( 'taylor_typography_headings', [
            'title' => __( 'Headings' ),
            'description' => __( 'Custom headings' ),
            'panel' => 'taylor_typography', // Not typically needed.
            'priority' => 160,
            'capability' => 'edit_theme_options',
            'theme_supports' => '', // Rarely needed.
        ] );

        $wp_customize->add_setting( 'taylor_heading_font', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => [$this, 'sanitizeFont'],
            'default' => array_key_first( $this->fonts ),
          ) );
          
        $wp_customize->add_control( 'taylor_heading_font', [
            'type' => 'select',
            'section' => 'taylor_typography_headings', // Add a default or your own section
            'label' => __( 'Heading Font' ),
            'description' => __( 'Font family for headings' ),
            'choices' => $this->fonts,
        ] );

        $wp_customize->add_setting( 'taylor_h1_font_size', array(
            'capability' => 'edit_theme_options',
            'default' => '48px',
          ) );
          
        $wp_customize->add_control( 'taylor_h1_font_size', [
            'type' => 'text',
            'section' => 'taylor_typography_headings', // Add a default or your own section
            'label' => __( 'H1 Font Size' ),
        ] );

        $wp_customize->add_setting( 'taylor_h2_font_size', array(
            'capability' => 'edit_theme_options',
            'default' => '40px',
          ) );
          
        $wp_customize->add_control( 'taylor_h2_font_size', [
            'type' => 'text',
            'section' => 'taylor_typography_headings', // Add a default or your own section
            'label' => __( 'H2 Font Size' ),
        ] );

        $wp_customize->add_setting( 'taylor_h3_font_size', array(
            'capability' => 'edit_theme_options',
            'default' => '32px',
          ) );
          
        $wp_customize->add_control( 'taylor_h3_font_size', [
            'type' => 'text',
            'section' => 'taylor_typography_headings', // Add a default or your own section
            'label' => __( 'H3 Font Size' ),
        ] );

        $wp_customize->add_setting( 'taylor_h4_font_size', array(
            'capability' => 'edit_theme_options',
            'default' => '26px',
          ) );
          
        $wp_customize->add_control( 'taylor_h4_font_size', [
            'type' => 'text',
            'section' => 'taylor_typography_headings', // Add a default or your own section
            'label' => __( 'H4 Font Size' ),
        ] );

        $wp_customize->add_setting( 'taylor_h5_font_size', array(
            'capability' => 'edit_theme_options',
            'default' => '20px',
          ) );
          
        $wp_customize->add_control( 'taylor_h5_font_size', [
            'type' => 'text',
            'section' => 'taylor_typography_headings', // Add a default or your own section
            'label' => __( 'H5 Font Size' ),
        ] );

        $wp_customize->add_setting( 'taylor_h6_font_size', array(
            'capability' => 'edit_theme_options',
            'default' => '16px',
          ) );
          
        $wp_customize->add_control( 'taylor_h6_font_size', [
            'type' => 'text',
            'section' => 'taylor_typography_headings', // Add a default or your own section
            'label' => __( 'H6 Font Size' ),
        ] );

        $wp_customize->add_section( 'taylor_typography_content', [
            'title' => __( 'Content' ),
            'description' => __( 'Custom content fonts' ),
            'panel' => 'taylor_typography', // Not typically needed.
            'priority' => 160,
            'capability' => 'edit_theme_options',
            'theme_supports' => '', // Rarely needed.
        ] );

        $wp_customize->add_setting( 'taylor_body_font', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => [$this, 'sanitizeFont'],
            'default' => array_key_first( $this->fonts ),
          ) );
          
        $wp_customize->add_control( 'taylor_body_font', [
            'type' => 'select',
            'section' => 'taylor_typography_content', // Add a default or your own section
            'label' => __( 'Body Font' ),
            'description' => __( 'Font family for body content' ),
            'choices' => $this->fonts,
        ] );

        $wp_customize->add_setting( 'taylor_body_font_size', array(
            'capability' => 'edit_theme_options',
            'default' => '16px',
          ) );
          
        $wp_customize->add_control( 'taylor_body_font_size', [
            'type' => 'text',
            'section' => 'taylor_typography_content', // Add a default or your own section
            'label' => __( 'Body Font Size' ),
        ] );

        $wp_customize->add_section( 'taylor_typography_branding', [
            'title' => __( 'Branding' ),
            'description' => __( 'Custom branding styles' ),
            'panel' => 'taylor_typography', // Not typically needed.
            'priority' => 160,
            'capability' => 'edit_theme_options',
            'theme_supports' => '', // Rarely needed.
        ] );

        $wp_customize->add_setting( 'taylor_branding_name_font', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => [$this, 'sanitizeFont'],
            'default' => array_key_first( $this->fonts ),
          ) );
          
        $wp_customize->add_control( 'taylor_branding_name_font', [
            'type' => 'select',
            'section' => 'taylor_typography_branding', // Add a default or your own section
            'label' => __( 'Site Name Font' ),
            'description' => __( 'Font family for site name' ),
            'choices' => $this->fonts,
        ] );

        $wp_customize->add_setting( 'taylor_branding_name_font_size', array(
            'capability' => 'edit_theme_options',
            'default' => '24px',
          ) );
          
        $wp_customize->add_control( 'taylor_branding_name_font_size', [
            'type' => 'text',
            'section' => 'taylor_typography_branding', // Add a default or your own section
            'label' => __( 'Site Name Font Size' ),
        ] );

        $wp_customize->add_setting( 'taylor_branding_tagline_font', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => [$this, 'sanitizeFont'],
            'default' => array_key_first( $this->fonts ),
          ) );
          
        $wp_customize->add_control( 'taylor_branding_tagline_font', [
            'type' => 'select',
            'section' => 'taylor_typography_branding', // Add a default or your own section
            'label' => __( 'Site Tagline Font' ),
            'description' => __( 'Font family for site tagline' ),
            'choices' => $this->fonts,
        ] );

        $wp_customize->add_setting( 'taylor_branding_tagline_font_size', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => [$this, 'sanitizeFont'],
            'default' => '14px',
          ) );
          
        $wp_customize->add_control( 'taylor_branding_tagline_font_size', [
            'type' => 'text',
            'section' => 'taylor_typography_branding', // Add a default or your own section
            'label' => __( 'Site Tagline Font Size' ),
        ] );

        $wp_customize->add_section( 'taylor_typography_menus', [
            'title' => __( 'Menus' ),
            'description' => __( 'Custom menu styles' ),
            'panel' => 'taylor_typography', // Not typically needed.
            'priority' => 160,
            'capability' => 'edit_theme_options',
            'theme_supports' => '', // Rarely needed.
        ] );

        $wp_customize->add_setting( 'taylor_primary_menu_font', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => [$this, 'sanitizeFont'],
            'default' => array_key_first( $this->fonts ),
          ) );
          
        $wp_customize->add_control( 'taylor_primary_menu_font', [
            'type' => 'select',
            'section' => 'taylor_typography_menus', // Add a default or your own section
            'label' => __( 'Primary Menu font' ),
            'description' => __( 'Font family for primary menu' ),
            'choices' => $this->fonts,
        ] );
    }

    public function sanitizeFont( $input, $setting ) {
      
        // Include $fonts array
        //include_once( get_stylesheet_directory() . '/inc/customizer/google-fonts.php' );
      
        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $this->fonts ) ? $input : array_key_first( $this->fonts ) );
    }

    public function sanitizeTaglineDisplay( $input, $setting ) {
      
        $taglineDisplayOptions = [
            'hidden' => 'Hidden',
            'stacked' => 'Stacked',
            'inline' => 'Inline'
        ];
      
        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $taglineDisplayOptions ) ? $input : array_key_first( $taglineDisplayOptions ) );
    }
}