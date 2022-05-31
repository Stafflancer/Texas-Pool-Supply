<?php
wp_enqueue_style('hero-banner-common-styles', get_template_directory_uri() . '/static/css/modules/hero-banner-common/hero-banner-common.css', '', '', 'all');

$heading = get_field('heading');
$subheading = get_field('subheading');
$content = get_field('content');
$button = get_field('button');

// If no rows have been added, then bail.
if (empty($heading) && empty($content)) {
    return '';
}

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-banner-common-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$sectionClassName = 'hero-banner-common';

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
            <div class="left-col">
                <?php if ($heading) { ?>
                    <h3 class="<?php echo esc_attr($blockSettings['heading_color']); ?>"><?php echo $heading; ?></h3>
                <?php }

                if (!empty($subheading)) { ?>
                    <div class="subheading <?php echo esc_attr($blockSettings['text_color']); ?>">
                        <?php echo $subheading; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="right-col">
                <?php if (!empty($content)) { ?>
                    <div class="content <?php echo esc_attr($blockSettings['text_color']); ?>">
                        <?php echo $content; ?>
                    </div>
                <?php }
                if (!empty($button['button'])) { ?>
                    <div class="btn-holder">
                        <?php heritage_display_block_button($button); ?>
                    </div>
                <?php } ?>
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
