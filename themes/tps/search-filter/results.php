<?php
/**
 * Search & Filter Pro
 *
 * Sample Results Template
 *
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 *
 * Note: these templates are not full page templates, rather
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think
 * of it as a template part
 *
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs
 * and using template tags -
 *
 * http://codex.wordpress.org/Template_Tags
 *
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

if ($query->have_posts()) { ?>
    <div class="posts">
        <?php while ($query->have_posts()) {
            $query->the_post(); ?>

            <div class="event-post-card">
                <div class="holder">
                    <?php
                    $title = get_the_title();
                    if (!empty($title)) { ?>
                        <a href="<?php the_permalink(); ?>" class="title">
                            <?php echo $title; ?>
                        </a>
                    <?php }

                    $location = get_post_meta(get_the_ID(), 'event_location_name');
                    if (!empty($location[0])) { ?>
                        <div class="location">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                 y="0px"
                                 width="466.583px" height="466.582px" viewBox="0 0 466.583 466.582"
                                 style="enable-background:new 0 0 466.583 466.582;"
                                 xml:space="preserve">
                                <path d="M233.292,0c-85.1,0-154.334,69.234-154.334,154.333c0,34.275,21.887,90.155,66.908,170.834
                                    c31.846,57.063,63.168,104.643,64.484,106.64l22.942,34.775l22.941-34.774c1.317-1.998,32.641-49.577,64.483-106.64
                                    c45.023-80.68,66.908-136.559,66.908-170.834C387.625,69.234,318.391,0,233.292,0z M233.292,233.291c-44.182,0-80-35.817-80-80
                                    s35.818-80,80-80c44.182,0,80,35.817,80,80S277.473,233.291,233.292,233.291z"/>
                            </svg>
                            <?php echo $location[0]; ?>
                        </div>
                    <?php } ?>

                    <?php
                    $event_start_date = get_post_meta(get_the_ID(), '_event_start_date');
                    $event_start_date = date("F d, Y", strtotime($event_start_date[0]));

                    $event_end_date = get_post_meta(get_the_ID(), '_event_end_date');
                    $event_end_date = date("F d, Y", strtotime($event_end_date[0]));

                    $event_start_time = get_post_meta(get_the_ID(), '_event_start_time');
                    $event_start_time = date("g:i a", strtotime($event_start_time[0]));

                    $event_end_time = get_post_meta(get_the_ID(), '_event_end_time');
                    $event_end_time = date("g:i a", strtotime($event_end_time[0]));

                    if (!empty($event_start_date) && !empty($event_end_date) && !empty($event_start_time) && !empty($event_end_time)) { ?>
                        <div class="date">
                            <?php echo $event_start_date . ', ' . $event_start_time . ' - ' . $event_end_date . ', ' . $event_end_time; ?>
                        </div>
                    <?php } ?>

                    <div class="btns-holder">
                        <a href="#" class="custom-btn btn-theme-red">
                            <?php _e('Register', 'tps'); ?> >
                        </a>
                        <a href="#" class="custom-btn btn-theme-light-gray ">
                            <?php _e('Learn More', 'tps'); ?> >
                        </a>
                    </div>
                </div>
            </div>
            <?php
        } ?>
    </div>
    <?php
} else {
    echo "No Results Found";
}
?>