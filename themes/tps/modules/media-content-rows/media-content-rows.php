<?php
wp_enqueue_style('media-content-rows-styles', get_template_directory_uri() . '/static/css/modules/media-content-rows/media-content-rows.css', '', '', 'all');

$media_initial_position = get_field('media_initial_position');

// If no rows have been added, then bail.
if (!have_rows('content_rows')) {
    return '';
}

// Create id attribute allowing for custom "anchor" value.
$id = 'media-content-rows-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$sectionClassName = 'media-content-rows';

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
        <div class="section-holder <?php echo $media_initial_position; ?>">
            <?php while (have_rows('content_rows')) {
                the_row(); ?>
                <div class="content-row">
                    <?php
                    $image = get_sub_field('image');
                    $heading = get_sub_field('heading');
                    $content = get_sub_field('content');

                    if (!empty($image)) { ?>
                        <div class="image">
                            <?php echo wp_get_attachment_image($image, 's_490'); ?>
                        </div>
                    <?php } ?>

                    <div class="content-col">
                        <?php if (!empty($heading)) { ?>
                            <h3 class="<?php echo esc_attr($blockSettings['heading_color']); ?>"><?php echo $heading; ?></h3>
                        <?php }
                        if (!empty($content)) { ?>
                            <div class="content <?php echo esc_attr($blockSettings['text_color']); ?>"><?php echo $content; ?></div>
                        <?php }
                        if (have_rows('buttons')) { ?>
                            <div class="btns">
                                <?php while (have_rows('buttons')) {
                                    the_row();
                                    $button = get_sub_field('button');
                                    if (!empty($button)) {
                                        heritage_display_block_button($button);
                                    }
                                } ?>
                            </div>
                        <?php } ?>
                    </div>
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
<?php if (have_rows('bg_images')) : ?>
    <div class="bg-images">
        <?php while (have_rows('bg_images')) : the_row();
            $image = get_sub_field('image');
            if (!empty($image)) :
                echo wp_get_attachment_image($image, 'full');
            endif;
        endwhile; ?>
    </div>
<?php endif; ?>
</section>
