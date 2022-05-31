<?php
$page_title = get_field('page_title');
$page_description = get_field('page_description');

if (!empty($page_title) || !empty($page_description)) {
    wp_enqueue_style('page-template-1-block-styles', get_template_directory_uri() . '/static/css/modules/page-template-1-block/page-template-1-block.css', '', '', 'all'); ?>

    <section class="page-template-1-block wow fadeIn">
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

            <?php if (!empty($page_title)) { ?>
                <h2>
                    <?php echo $page_title; ?>
                </h2>
            <?php }

            if (!empty($page_description)) { ?>
                <div class="description">
                    <?php echo $page_description; ?>
                </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>
