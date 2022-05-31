<?php

if (have_rows('logos_carousel')) {
    wp_enqueue_style('slick-css', get_template_directory_uri() . '/static/css/slick.min.css', '', '', 'all');
}

wp_enqueue_style('carousel-logos-styles', get_template_directory_uri() . '/static/css/modules/carousel-logos/carousel-logos.css', '', '', 'all');

if (have_rows('logos_carousel')) {
    wp_enqueue_script('slick-js', get_template_directory_uri() . '/static/js/slick.min.js', array('jquery'), '', true);
    wp_enqueue_script('carousel-logos-js', get_template_directory_uri() . '/static/js/modules/carousel-logos/carousel-logos.js', '', '', true);
}

$title = get_field('title');

// If no rows have been added, then bail.
if (!have_rows('logos_carousel')) {
    return '';
}

// Create id attribute allowing for custom "anchor" value.
$id = 'carousel-logos-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$sectionClassName = 'carousel-logos';

if (!empty($block['className'])) {
    $sectionClassName .= ' ' . $block['className'];
}

$sectionClassName .= $block['align'] ? ' align' . $block['align'] : '';

// Create class attribute allowing for custom "block_width", "full_height", "align_text" and "align_content" values.
$layoutClassName = '';

// Parse settings.
$blockSettings = get_template_acf_block_settings($block);

// Join layout classes for the block, this differs per block.
$layoutClassName = join(' ', [
    $layoutClassName,
    $blockSettings['align_text'],
    $blockSettings['align_content']
]);

/**
 * Block Content
 */
// Load values and assign defaults.
$video_mp4 = get_field('video_mp4');
$video_webm = get_field('video_webm');

// Start a <container> with possible block options.
heritage_display_block_background_options([
    'container' => 'section', // Any HTML5 container: section, div, etc...
    'id' => $id, // Container id.
    'class' => $sectionClassName, // Container class.
]);
?>
<div class="<?php echo esc_attr($layoutClassName); ?>">
    <div class="container <?php echo esc_attr($blockSettings['animation']); ?>">
        <?php if (!empty($title)) { ?>
            <h3 class="<?php echo esc_attr($blockSettings['heading_color']); ?>"><?php echo $title; ?></h3>
        <?php } ?>

        <div class="logos_carousel">
            <?php while (have_rows('logos_carousel')) {
                the_row();
                $image = get_sub_field('image');
                $url = get_sub_field('url'); ?>

                <?php if (!empty($url)) { ?>
                    <a href="<?php echo $url; ?>" class="logo">
                        <?php if ($image) { ?>
                            <div class="image">
                                <?php echo wp_get_attachment_image($image, 'full'); ?>
                            </div>
                        <?php } ?>
                    </a>
                <?php } else { ?>
                    <div class="brand">
                        <?php if ($image) { ?>
                            <div class="image">
                                <?php echo wp_get_attachment_image($image, 'full'); ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
    <?php if ($video_mp4 || $video_webm): ?>
        <video id="hero-video" class="video" playsinline webkit-playsinline loop muted autoplay>
            <?php
            if (!empty($video_webm)):
                echo '<source src="' . $video_webm['url'] . '" type="video/mp4">';
            endif;

            if (!empty($video_mp4)):
                echo '<source src="' . $video_mp4['url'] . '" type="video/mp4">';
            endif;
            ?>
        </video>
    <?php endif; ?>
</div>
</section>
