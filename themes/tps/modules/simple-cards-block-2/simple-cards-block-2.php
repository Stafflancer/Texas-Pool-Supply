<?php
wp_enqueue_style('simple-cards-block-2-styles', get_template_directory_uri() . '/static/css/modules/simple-cards-block-2/simple-cards-block-2.css', '', '', 'all');

// If no rows have been added, then bail.
if (!have_rows('cards')) {
    return '';
}

// Create id attribute allowing for custom "anchor" value.
$id = 'simple-cards-2-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$sectionClassName = 'simple-cards-block-2';

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
            <div class="cards">
                <?php while (have_rows('cards')) : the_row(); ?>
                    <a href="<?php the_sub_field('link'); ?>" class="card">
                        <div class="holder">
                            <h3><?php the_sub_field('heading'); ?></h3>
                            <?php
                            $content = get_sub_field('content');
                            if (!empty($content)) { ?>
                                <div class="content">
                                    <?php echo $content; ?>
                                </div>
                            <?php } ?>

                            <div class="btn-holder">
                                <span><?php _e('Learn More >', 'tps'); ?></span>
                            </div>
                        </div>
                    </a>
                <?php endwhile; ?>
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
