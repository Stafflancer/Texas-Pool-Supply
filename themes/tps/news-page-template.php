<?php
/* Template Name: News Page Template */
get_header(); ?>

<main>
    <?php
    get_template_part('modules/page-template-1-block/page-template-1-block');
    get_template_part('modules/news-posts-grid/news-posts-grid');

    while (have_posts()) : the_post();
        the_content();
    endwhile;
    ?>
</main>

<?php get_footer(); ?>
