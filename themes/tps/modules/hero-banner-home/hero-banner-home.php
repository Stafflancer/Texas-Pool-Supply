<?php
if (have_rows('bg_images')) {
    wp_enqueue_style('slick-css', get_template_directory_uri() . '/static/css/slick.min.css', '', '', 'all');
}

wp_enqueue_style('hero-banner-home-styles', get_template_directory_uri() . '/static/css/modules/hero-banner-home/hero-banner-home.css', '', '', 'all');

if (have_rows('bg_images')) {
    wp_enqueue_script('slick-js', get_template_directory_uri() . '/static/js/slick.min.js', array('jquery'), '', true);
    wp_enqueue_script('hero-banner-home-js', get_template_directory_uri() . '/static/js/modules/hero-banner-home/hero-banner-home.js', '', '', true);
}

$heading = get_field('heading');
$content = get_field('content');

// If no rows have been added, then bail.
if (empty($heading) && $content) {
    return '';
}

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-banner-home-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$sectionClassName = 'hero-banner-home';

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
    <div class="hero-banner__text-block container <?php echo esc_attr($blockSettings['animation']); ?>">
        <h1 class="heading <?php echo esc_attr($blockSettings['heading_color']); ?>"><?php echo $heading; ?></h1>
        <div class="content <?php echo esc_attr($blockSettings['text_color']); ?>">
            <?php echo $content; ?>
        </div>
        <?php if (have_rows('buttons')) : ?>
            <div class="buttons-holder">
                <?php
                while (have_rows('buttons')): the_row();
                    $button = get_sub_field('button');

                    if (!empty($button)):
                        heritage_display_block_button($button);
                    endif;
                endwhile;
                ?>
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
