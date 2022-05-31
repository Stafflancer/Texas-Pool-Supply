<?php get_header(); ?>

    <main>
        <?php
        echo get_template_part('modules/single-store-info/single-store-info');
        while (have_posts()) : the_post();
            the_content();
        endwhile;
        ?>
    </main>

<?php get_footer();
