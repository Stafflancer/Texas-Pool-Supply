<?php
wp_enqueue_style('vendors-posts-grid-styles', get_template_directory_uri() . '/static/css/modules/vendors-posts-grid/vendors-posts-grid.css', '', '', 'all'); ?>

<section class="vendors-posts-grid wow fadeIn">
    <div class="container">
        <div class="section-holder">
            <?php
            $args = array(
                'post_type' => 'vendor',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order'   => 'ASC'
            );
            $vendor_posts = new WP_Query($args);

            if ($vendor_posts->have_posts()) { ?>
                <div class="posts">
                    <?php foreach ($vendor_posts->posts as $post) {
                        $post_id = $post->ID;
                        get_template_part('template-parts/vendor-post-card', '', array('post_id' => $post_id));
                    } ?>
                </div>
            <?php }
            wp_reset_postdata(); ?>
        </div>
    </div>
</section>