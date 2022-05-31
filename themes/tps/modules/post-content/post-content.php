<?php wp_enqueue_style('post-content-styles', get_template_directory_uri() . '/static/css/modules/post-content/post-content.css', '', '', 'all'); ?>

<?php
$post_id = get_queried_object_id();
$current_post = get_post($post_id);
$post_content = apply_filters('the_content', $current_post->post_content);

if (!empty($args['breadcrubms'])) {
    $breadcrubms = $args['breadcrubms'];
} ?>

<section class="post-content wow fadeIn">
    <div class="container">
        <div class="section-holder">
            <div class="breadcrumbs">
                <a href="<?php echo home_url('/education/'); ?>">
                    <?php _e('About', 'tps'); ?>
                </a>
                <span class="divider">/</span>
                <?php if (!empty($breadcrubms)) { ?>
                    <span><?php echo $breadcrubms; ?></span>
                <?php } ?>
            </div>

            <?php if (!empty($post_content)) { ?>
                <div class="content-holder">
                    <?php echo $post_content; ?>
                </div>
            <?php } ?>

            <div class="post-navigation">
                <div class="prev">
                    <?php previous_post_link('« %link', 'Previous'); ?>
                </div>
                <div class="next">
                    <?php next_post_link('%link »', 'Next'); ?>
                </div>
            </div>
        </div>
    </div>
</section>