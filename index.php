<?php
    /**
     * @package ThemeGraciet
     */

    get_header();
?>
    <div id="" class="">
        <main id="" class="" role="main">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                endwhile;
            else :
                get_template_part( 'template-parts/content', 'none' );
            endif; ?>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
    get_footer();