<?php
$gallery = get_field('gallery');

if (!empty($gallery)) {
    wp_enqueue_style('slick-css', get_template_directory_uri() . '/static/css/slick.min.css', '', '', 'all');
    wp_enqueue_script('slick-js', get_template_directory_uri() . '/static/js/slick.min.js', array('jquery'), '', true);
    wp_enqueue_script('single-store-info-js', get_template_directory_uri() . '/static/js/modules/single-store-info/single-store-info.js', '', '', true);
}

wp_enqueue_style('single-store-info-styles', get_template_directory_uri() . '/static/css/modules/single-store-info/single-store-info.css', '', '', 'all'); ?>

<section class="single-store-info wow fadeIn">
    <div class="container">
        <div class="cols">
            <div class="info-col">
                <div class="breadcrumbs">
                    <span>
                        <?php _e("Locations", 'tps'); ?>
                    </span>
                </div>
                <h2><?php the_title(); ?></h2>
                <div class="info">
                    <?php
                    echo do_shortcode('[wpsl_address]');
                    echo do_shortcode('[wpsl_hours]'); ?>
                </div>
                <a href="<?php echo get_the_permalink(14) ?>" class="custom-btn btn-theme-red">
                    <?php _e('View All Locations', 'tps'); ?>
                </a>
            </div>
            <div class="map-col">
                <?php echo do_shortcode('[wpsl_map]');

                if (!empty($gallery)) { ?>
                    <div class="gallery gallery-slick">
                        <?php foreach ($gallery as $image_id) { ?>
                            <div class="img"><?php echo wp_get_attachment_image($image_id, 'full'); ?></div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>