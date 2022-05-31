<?php wp_enqueue_style('events-posts-grid-styles', get_template_directory_uri() . '/static/css/modules/events-posts-grid/events-posts-grid.css', '', '', 'all'); ?>

<section class="events-posts-grid wow fadeIn">
    <div class="container">
        <?php
        $upcomming_events_section_title = get_field('upcomming_events_section_title');
        $upcomming_events_section_subtitle = get_field('upcomming_events_section_subtitle');

        if (!empty($upcomming_events_section_title)) { ?>
            <h3>
                <?php echo $upcomming_events_section_title ?>
            </h3>
        <?php }

        if (!empty($upcomming_events_section_subtitle)) { ?>
            <div class="subtitle">
                <?php echo $upcomming_events_section_subtitle; ?>
            </div>
        <?php } ?>

        <div class="filters-holder">
            <?php echo do_shortcode('[searchandfilter id="722"]'); ?>
        </div>

        <?php echo do_shortcode('[searchandfilter id="722" show="results"]'); ?>
    </div>
</section>