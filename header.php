<?php 

$meta = get_post_meta( get_the_ID() );
$taglineDisplay = esc_html( get_theme_mod('taylor_tagline_display') );

?>

<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <meta name=description content="<?php echo get_bloginfo('description'); ?>">

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php
		wp_body_open();
		?>

		<header <?php if ( $meta['taylor_use_transparent_header'][0] === 'true' ) echo 'class="transparent"'; ?> role="banner">

            <div class="container container--wide">

                <a href="<?php bloginfo('url'); ?>" class="branding branding--<?php if ( $taglineDisplay !== 'hidden') { echo $taglineDisplay; } ?>">
                    <div class="name">
                        <?php bloginfo( 'name' ); ?>
                    </div>
                    <?php if ( $taglineDisplay !== 'hidden' ) : ?>
                    <div class="description">
                        <?php bloginfo( 'description' ); ?>
                    </div>
                    <?php endif; ?>
                </a>

                <nav>
                    <?php
                    wp_nav_menu(
                        [
                            'container'  => '',
                            'items_wrap' => '%3$s',
                            'theme_location' => 'primary',
                        ]
                    );
                    ?>
                </nav>

            </div>

		</header><!-- #site-header -->
