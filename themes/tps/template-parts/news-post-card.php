<?php if (!empty($args['post_id'])) {
    $post_id = $args['post_id'];
    $title = get_the_title($post_id); ?>

    <a href="<?php echo get_the_permalink($post_id); ?>" class="news-post-card">
        <div class="holder">
            <div class="date">
                <?php echo get_the_date('F d, Y'); ?>
            </div>
            <?php if (!empty($title)) { ?>
                <div class="title">
                    <?php echo $title; ?>
                </div>
            <?php } ?>
            <div class="btn-holder">
                <span class="custom-btn btn-theme-red">
                    <?php _e('VIEW', 'fis'); ?>
                </span>
            </div>
        </div>
    </a>
<?php } ?>