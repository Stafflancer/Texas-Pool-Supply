<?php
wp_enqueue_style('cover-image-block-styles', get_template_directory_uri() . '/static/css/modules/cover-image-block/cover-image-block.css', '', '', 'all');

$title = get_field('title');
$content = get_field('content');
$image = get_field('image');

// If no rows have been added, then bail.
if (empty($title) || empty($content)) {
    return '';
}

// Create id attribute allowing for custom "anchor" value.
$id = 'cover-image-block-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$sectionClassName = 'cover-image-block';

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
    <?php if (!empty($title) || !empty($content)) { ?>
        <div class="top-holder">
            <div class="container">
                <div class="breadcrumbs">
                    <?php
                    $parent_post = get_post()->post_parent;
                    if (!empty($parent_post)) { ?>
                        <a href="<?php echo get_permalink($parent_post); ?>">
                            <?php echo get_the_title($parent_post); ?>
                        </a>
                        <span class="divider">/</span>
                    <?php } ?>
                    <span><?php the_title(); ?></span>
                </div>

                <?php if (!empty($title)) { ?>
                    <h2 class="<?php echo esc_attr($blockSettings['heading_color']); ?>"><?php echo $title; ?></h2>
                <?php }

                if (!empty($content)) { ?>
                    <div class="content <?php echo esc_attr($blockSettings['text_color']); ?>"><?php echo $content; ?></div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>

    <?php if (!empty($image)) {
        $image_url = wp_get_attachment_image_url($image, 'full'); ?>
        <div class="image-holder" style="background-image: url('<?php echo $image_url; ?>')"></div>
    <?php } ?>

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
