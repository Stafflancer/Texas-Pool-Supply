<?php
global $wp_query;

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 12,
    'paged' => get_query_var('paged') ?: 1,
);

$wp_query = new WP_Query($args);

if (have_posts()) {
    wp_enqueue_style('news-posts-grid-styles', get_template_directory_uri() . '/static/css/modules/news-posts-grid/news-posts-grid.css', '', '', 'all'); ?>

    <section class="news-posts-grid wow fadeIn">
        <div class="container">
            <div class="section-holder">
                <div class="posts">
                    <?php while (have_posts()) { the_post();
                        $post_id = get_post();
                        get_template_part('template-parts/news-post-card', '', array('post_id' => $post_id));
                    } ?>
                </div>

                <?php the_posts_pagination([
                    'prev_text' => '&#171;',
                    'next_text' => '&#187;',
                    'mid_size' => 1
                ]);

                wp_reset_query(); ?>
            </div>
        </div>
    </section>
<?php } ?>