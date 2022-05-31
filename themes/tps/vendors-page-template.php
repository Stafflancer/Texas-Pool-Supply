<?php
/* Template Name: Vendors Page Template */
get_header(); ?>

<main>
    <?php
    get_template_part('modules/page-template-1-block/page-template-1-block');
    get_template_part('modules/vendors-posts-grid/vendors-posts-grid');

    while (have_posts()) : the_post();
        the_content();
    endwhile;
    ?>
</main>

<?php get_footer(); ?>
