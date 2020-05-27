<?php

get_header();

$meta = get_post_meta( get_the_ID() );

$classList = '';
if ( $meta['taylor_remove_top_spacing'][0] === 'true' ) {
    $classList .= 'top-spacing-removed ';
}
if ( $meta['taylor_remove_bottom_spacing'][0] === 'true' ) {
    $classList .= 'bottom-spacing-removed ';
}
$classList = trim($classList);

?>

<main  <?php if ( !empty($classList) ) echo "class=\"{$classList}\""; ?> role="main">

    <?php

    if ( have_posts() ) {

        while ( have_posts() ) {
            the_post();

            get_template_part( 'template-parts/content', get_post_type() );
        }
    }

    ?>

</main>

<?php

get_footer();
