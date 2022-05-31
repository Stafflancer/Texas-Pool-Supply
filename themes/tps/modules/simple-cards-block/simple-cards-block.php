<?php
wp_enqueue_style('simple-cards-block-styles', get_template_directory_uri() . '/static/css/modules/simple-cards-block/simple-cards-block.css', '', '', 'all');

$title = get_field('title');
$subtitle = get_field('subtitle');
$cards_per_row = get_field('cards_per_row');

// If no rows have been added, then bail.
if (!have_rows('cards')) {
    return '';
}

// Create id attribute allowing for custom "anchor" value.
$id = 'simple-cards-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$sectionClassName = 'simple-cards-block';

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
            <h3 class="heading <?php echo esc_attr($blockSettings['heading_color']); ?>"><?php echo $title; ?></h3>
        <?php }

        if (!empty($subtitle)) { ?>
            <div class="content <?php echo esc_attr($blockSettings['text_color']); ?>">
                <?php echo $subtitle; ?>
            </div>
        <?php }

        if (have_rows('cards')) : ?>
            <div class="cards-holder cols-<?php echo $cards_per_row; ?>">
                <?php
                while (have_rows('cards')): the_row();
                    $image = get_sub_field('image');
                    $heading = get_sub_field('heading');
                    $link = get_sub_field('link');

                    if (!empty($link)) { ?>
                        <a class="card <?php echo esc_attr($blockSettings['text_color']); ?>"
                           href="<?php echo $link; ?>">
                            <?php if (!empty($image)) : ?>
                                <div class="image-holder">
                                    <?php echo wp_get_attachment_image($image, 'full'); ?>
                                </div>
                            <?php endif; ?>
                            <h5><?php echo $heading; ?></h5>
                        </a>
                    <?php } else { ?>
                        <div class="card <?php echo esc_attr($blockSettings['text_color']); ?>">
                            <?php if (!empty($image)) : ?>
                                <div class="image-holder">
                                    <?php echo wp_get_attachment_image($image, 'full'); ?>
                                </div>
                            <?php endif; ?>
                            <h5><?php echo $heading; ?></h5>
                        </div>
                    <?php }
                endwhile; ?>
            </div>
        <?php endif; ?>
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
