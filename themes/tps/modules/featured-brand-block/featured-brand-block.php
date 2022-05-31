<?php
wp_enqueue_style('featured-brand-block-styles', get_template_directory_uri() . '/static/css/modules/featured-brand-block/featured-brand-block.css', '', '', 'all');

$brand_id = get_field('brand');

// If no rows have been added, then bail.
if (empty($brand_id)) {
    return '';
}

// Create id attribute allowing for custom "anchor" value.
$id = 'featured-brand-block-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$sectionClassName = 'featured-brand-block';

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
<div class="<?php echo esc_attr($layoutClassName);
echo esc_attr($blockSettings['animation']); ?>">
    <div class="container">
        <div class="section-holder">
            <?php
            $post_title = get_the_title($brand_id);
            $post_content = apply_filters('the_content', get_post_field('post_content', $brand_id));
            $post_thumbnail = get_the_post_thumbnail($brand_id);

            if (!empty($post_thumbnail)) { ?>
                <div class="thumbnail">
                    <?php echo $post_thumbnail; ?>
                </div>
            <?php } ?>

            <div class="content-holder">
                <?php if (!empty($post_title)) { ?>
                    <h3 class="<?php echo esc_attr($blockSettings['heading_color']); ?>"><?php echo $post_title; ?></h3>
                <?php }
                if (!empty($post_content)) { ?>
                    <div class="post-content <?php echo esc_attr($blockSettings['text_color']); ?>">
                        <?php echo $post_content; ?>
                    </div>
                <?php } ?>
                <a href="<?php echo get_the_permalink($brand_id)?>" class="custom-btn btn-theme-red">
                    <?php _e("Read More", 'tps'); ?>
                </a>
            </div>
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
