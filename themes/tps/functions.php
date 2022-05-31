<?php
add_theme_support('post-thumbnails');
add_post_type_support( 'page', 'excerpt' );

/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'embed_head', 'print_emoji_detection_script' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Add body class
 */
function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

/*
 * Include files
 */
$include_folders = array(
    'includes/'
);
foreach ($include_folders as $inc_folder) {
    $include_folder = get_stylesheet_directory() . '/' . $inc_folder;
    foreach (glob($include_folder . '*.php') as $file) {
        require_once $file;
    }
}

/*
 * Enqueue style/script files
 */
function inclusion_enqueue() {
    wp_enqueue_style('animate-css', get_template_directory_uri() . '/static/css/animate.min.css', [], '', 'all');
    wp_enqueue_style('main', get_template_directory_uri() . '/static/css/main.min.css', [], '', 'all');
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', ['main'], '', 'all');

    wp_enqueue_script('wow-script', get_template_directory_uri() . '/static/js/wow.min.js', '', '', true);
    wp_enqueue_script('scripts', get_template_directory_uri() . '/static/js/main.min.js', ['jquery'], '', true);
}
add_action('wp_enqueue_scripts', 'inclusion_enqueue');