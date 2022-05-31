<?php
wp_enqueue_style('simple-icons-block-styles', get_template_directory_uri() . '/static/css/modules/simple-icons-block/simple-icons-block.css', '', '', 'all');

$heading = get_field('heading');
$content = get_field('content');

// If no rows have been added, then bail.
if (!have_rows('columns')) {
    return '';
}

// Create id attribute allowing for custom "anchor" value.
$id = 'simple-icons-block-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$sectionClassName = 'simple-icons-block';

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
        <div class="section-holder">
            <?php if (!empty($heading)) { ?>
                <h3 class="<?php echo esc_attr($blockSettings['heading_color']); ?>"><?php echo $heading; ?></h3>
            <?php }

            if (!empty($content)) { ?>
                <div class="content <?php echo esc_attr($blockSettings['text_color']); ?>">
                    <?php echo $content; ?>
                </div>
            <?php }

            if (have_rows('columns')) {
                $items_per_row = get_field('items_per_row'); ?>

                <div class="columns cols-<?php echo $items_per_row; ?>">
                    <?php while (have_rows('columns')) : the_row(); ?>
                        <div class="item">
                            <?php
                            $icon = get_sub_field('icon');
                            if ($icon) { ?>
                                <div class="icon">
                                    <?php echo wp_get_attachment_image($icon, 'full'); ?>
                                </div>
                            <?php } ?>

                            <div class="heading">
                                <?php the_sub_field('heading'); ?>
                            </div>

                            <?php
                            $item_content = get_sub_field('content');
                            if (!empty($item_content)) { ?>
                                <div class="item-content <?php echo esc_attr($blockSettings['text_color']); ?>">
                                    <?php echo $item_content; ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php } ?>
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