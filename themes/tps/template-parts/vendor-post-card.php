<?php if (!empty($args['post_id'])) {
    $post_id = $args['post_id'];
    $thumb = get_the_post_thumbnail($post_id);
    $title = get_the_title($post_id); ?>

    <a href="<?php echo get_the_permalink($post_id); ?>" class="vendor-post-card">
        <div class="white-block">
            <?php if (!empty($thumb)) { ?>
                <div class="thumb">
                    <?php echo $thumb; ?>
                </div>
            <?php }
            if (!empty($title)) { ?>
                <div class="title">
                    <?php echo $title; ?>
                </div>
            <?php } ?>
        </div>
        <div class="link-holder">
            <span><?php _e('SHOP'); echo ' ' . $title; ?> ></span>
        </div>
    </a>
<?php } ?>