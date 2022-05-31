<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blueAlliance
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset') ?>"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta content="" name="description"/>
    <meta content="" name="keywords"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <title>
        <?php
        global $page, $paged;
        wp_title('|', true, 'right');
        bloginfo('name');
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && (is_home() || is_front_page()))
            echo " | $site_description";
        if ($paged >= 2 || $page >= 2)
            echo ' | ' . sprintf(__('Page %s', 'dash-tech'), max($paged, $page));
        ?>
    </title>
    <?php wp_head() ?>
</head>

<body <?php body_class() ?>>
<?php wp_body_open(); ?>

<div class="wrapper">
    <header class="wow fadeInDown">
        <div class="container wide">
            <div class="section-wrapper">
                <?php
                $logo_id = get_field('header_logo', 'options');
                if (!empty($logo_id)) : ?>
                    <div class="h-logo-holder">
                        <a href="<?php echo get_site_url(); ?>" title="<?php bloginfo('name'); ?>"
                           class="h-logo">
                            <?php echo wp_get_attachment_image($logo_id, 'full'); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="h-menu-holder">
                    <?php if (has_nav_menu('header_menu')) { ?>
                        <div class="h-menu">
                            <?php wp_nav_menu(['theme_location' => 'header_menu', 'container' => '']);

                            if (have_rows('header_buttons', 'options')):
                                while (have_rows('header_buttons', 'options')): the_row();
                                    $button = get_sub_field('button');

                                    if (!empty($button)):
                                        heritage_display_block_button($button);
                                    endif;
                                endwhile;
                            endif; ?>
                        </div>

                        <button class="burger-btn">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <path d="M492,236H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h472c11.046,0,20-8.954,20-20S503.046,236,492,236z"/>
                                <path d="M492,76H20C8.954,76,0,84.954,0,96s8.954,20,20,20h472c11.046,0,20-8.954,20-20S503.046,76,492,76z"/>
                                <path d="M492,396H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h472c11.046,0,20-8.954,20-20
			                    C512,404.954,503.046,396,492,396z"/>
                            </svg>
                        </button>
                    <?php }

                    if (have_rows('header_buttons', 'options')):
                        while (have_rows('header_buttons', 'options')): the_row();
                            $button = get_sub_field('button');

                            if (!empty($button)):
                                heritage_display_block_button($button);
                            endif;
                        endwhile;
                    endif; ?>
                </div>
            </div>
        </div>
    </header>