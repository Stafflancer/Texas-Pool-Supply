<?php
wp_enqueue_style('contact-address-styles', get_template_directory_uri() . '/static/css/modules/contact-address/contact-address.css', '', '', 'all');

$address_1 = get_field('address_1');
$address_2 = get_field('address_2');
$button = get_field('button');

// If no rows have been added, then bail.
if (empty($address_1) || empty($address_2)) {
    return '';
}

// Create id attribute allowing for custom "anchor" value.
$id = 'contact-address-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$sectionClassName = 'contact-address';

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
        <div class="holder">
            <?php if (!empty($address_1)) { ?>
                <div class="address <?php echo esc_attr($blockSettings['text_color']); ?>">
                    <?php echo $address_1; ?>
                </div>
            <?php }

            if (!empty($address_2)) { ?>
                <div class="address <?php echo esc_attr($blockSettings['text_color']); ?>">
                    <?php echo $address_2; ?>
                </div>
            <?php }

            if (!empty($button['url'])) { ?>
                <div class="btn-holder">
                    <a href="<?php echo $button['url']; ?>" target="<?php echo !empty($button['target']) ? $button['target'] : '_self'; ?>" class="custom-btn btn-theme-red">
                        <?php echo $button['title']; ?>
                    </a>
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
