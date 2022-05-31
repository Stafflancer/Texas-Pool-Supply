<?php
wp_enqueue_style('sign-me-block-styles', get_template_directory_uri() . '/static/css/modules/sign-me-block/sign-me-block.css', '', '', 'all');

$title = get_field('title');
$subtitle = get_field('subtitle');
$form_code = get_field('form_code');

// If no rows have been added, then bail.
if (empty($form_code)) {
    return '';
}

// Create id attribute allowing for custom "anchor" value.
$id = 'sign-me-block-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$sectionClassName = 'sign-me-block';

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
    <div class="container section-holder <?php echo esc_attr($blockSettings['animation']); ?>">
        <?php if (!empty($title)) { ?>
            <h3 class="<?php echo esc_attr($blockSettings['heading_color']); ?>"><?php echo $title; ?></h3>
        <?php }

        if (!empty($subtitle)) { ?>
            <div class="subtitle <?php echo esc_attr($blockSettings['text_color']); ?>"><?php echo $subtitle; ?></div>
        <?php }

        if ($form_code) { ?>
            <div class="form-holder"><?php echo $form_code; ?></div>
        <?php } ?>
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
