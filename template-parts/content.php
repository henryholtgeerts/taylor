<?php
$meta = get_post_meta( get_the_ID() );
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <div class="content">
        <?php if ( $meta['taylor_hide_title'][0] !== 'true' ) {
            the_title('<h1 class="title">', '</h1>');
        } ?>
        <?php
        if ( is_search() || ! is_singular() ) {
            the_excerpt();
        } else {
            the_content( __( 'Continue reading', 'twentytwenty' ) );
        }
        ?>

    </div>

</article>
