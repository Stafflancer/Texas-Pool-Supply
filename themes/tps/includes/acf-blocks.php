<?php
add_action('acf/init', 'template_acf_init_block_types');

function template_acf_init_block_types()
{
    if (function_exists('acf_register_block_type')) {
        $homeURL = home_url();

        // Hero Banner - Home
        acf_register_block(array(
            'name' => 'hero-banner-home',
            'title' => __('Hero Banner - Home'),
            'description' => __('A custom home page hero banner block.'),
            'category' => 'acf-blocks',
            'icon' => array(
                'background' => '#004ea8',
                'foreground' => '#fff',
                'src' => 'admin-home',
            ),
            'keywords' => array('hero', 'banner', 'home'),
            'post_types' => array('page'),
            'mode' => 'edit',
            'supports' => array(
                'anchor' => true,
                'align' => false,
                'align_text' => true,
                'multiple' => false,
            ),
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array('content' => __('<img src="' . $homeURL . '/wp-content/uploads/2022/01/hero_banner.png">')),
                ),
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // Simple Cards Block
        acf_register_block(array(
            'name' => 'simple-cards-block',
            'title' => __('Simple Cards Block'),
            'description' => __('A custom simple cards block.'),
            'category' => 'acf-blocks',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#004ea8',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'grid-view',
            ),
            'keywords' => array('cards', 'block', 'simple'),
            'post_types' => array('page'),
            'mode' => 'edit',
            'supports' => array(
                'anchor' => true,
                'align' => false,
                'align_text' => true,
                //'align_content' => 'matrix',
                //'full_height'   => true,
                'multiple' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // Hero Banner - Common
        acf_register_block(array(
            'name' => 'hero-banner-common',
            'title' => __('Hero Banner - Common'),
            'description' => __('A custom Hero Banner block.'),
            'category' => 'acf-blocks',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#004ea8',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'cover-image',
            ),
            'keywords' => array('hero', 'banner', 'common'),
            'mode' => 'edit',
            'supports' => array(
                'anchor' => true,
                'align' => false,
                'multiple' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // Simple Icons Block
        acf_register_block(array(
            'name' => 'simple-icons-block',
            'title' => __('Simple Icons Block'),
            'description' => __('A custom simple icons block.'),
            'category' => 'acf-blocks',
            'icon' => array(
                // Specifying a background color to appear with the icon e.g.: in the inserter.
                'background' => '#004ea8',
                // Specifying a color for the icon (optional: if not set, a readable color will be automatically defined)
                'foreground' => '#fff',
                // Specifying a dashicon for the block
                'src' => 'networking',
            ),
            'keywords' => array('icons'),
            'mode' => 'edit',
            'supports' => array(
                'anchor' => true,
                'align' => false,
                'multiple' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // CTA - Side Form
        acf_register_block(array(
            'name' => 'cta-side-form',
            'title' => __('CTA - Side Form'),
            'description' => __('CTA - Side Form'),
            'category' => 'acf-blocks',
            'icon' => array(
                'background' => '#004ea8',
                'foreground' => '#fff',
                'src' => 'align-pull-left',
            ),
            'keywords' => array('cta', 'form', 'side'),
            'mode' => 'edit',
            'supports' => array(
                'anchor' => true,
                'align' => false,
                'multiple' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // Carousel - Logos Block
        acf_register_block(array(
            'name' => 'carousel-logos',
            'title' => __('Carousel - Logos'),
            'description' => __('Logo Carousel.'),
            'category' => 'acf-blocks',
            'icon' => array(
                'background' => '#004ea8',
                'foreground' => '#fff',
                'src' => 'columns',
            ), 'keywords' => array('carousel logos', 'carousel'),
            'mode' => 'edit',
            'supports' => array(
                'anchor' => true,
                'align' => false,
                'multiple' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // Subpage Listing
        acf_register_block(array(
            'name' => 'subpage-listing',
            'title' => __('Subpage Listing'),
            'description' => __('Subpage Listing.'),
            'category' => 'acf-blocks',
            'icon' => array(
                'background' => '#004ea8',
                'foreground' => '#fff',
                'src' => 'list-view',
            ), 'keywords' => array('subpage listing', 'listing'),
            'mode' => 'edit',
            'supports' => array(
                'anchor' => true,
                'align' => false,
                'multiple' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // Cover Image Block
        acf_register_block(array(
            'name' => 'cover-image-block',
            'title' => __('Cover Image Block'),
            'description' => __('Cover Image Block.'),
            'category' => 'acf-blocks',
            'icon' => array(
                'background' => '#004ea8',
                'foreground' => '#fff',
                'src' => 'cover-image',
            ), 'keywords' => array('cover image', 'cover'),
            'mode' => 'edit',
            'supports' => array(
                'anchor' => true,
                'align' => false,
                'multiple' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // Product Line Cards
        acf_register_block(array(
            'name' => 'product-line-cards',
            'title' => __('Product Line Cards'),
            'description' => __('Product Line Cards.'),
            'category' => 'acf-blocks',
            'icon' => array(
                'background' => '#004ea8',
                'foreground' => '#fff',
                'src' => 'schedule',
            ),
            'keywords' => array('product line cards', 'cards'),
            'mode' => 'edit',
            'supports' => array(
                'anchor' => true,
                'align' => false,
                'multiple' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // Sign Me Block
        acf_register_block(array(
            'name' => 'sign-me-block',
            'title' => __('Sign Me Block'),
            'description' => __('Sign Me Block'),
            'category' => 'acf-blocks',
            'icon' => array(
                'background' => '#004ea8',
                'foreground' => '#fff',
                'src' => 'edit',
            ),
            'keywords' => array('sign me'),
            'mode' => 'edit',
            'supports' => array(
                'anchor' => true,
                'align' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // Media Content Rows
        acf_register_block(array(
            'name' => 'media-content-rows',
            'title' => __('Media Content Rows'),
            'description' => __('Media Content Rows'),
            'category' => 'acf-blocks',
            'icon' => array(
                'background' => '#004ea8',
                'foreground' => '#fff',
                'src' => 'editor-table',
            ),
            'keywords' => array('content rows'),
            'mode' => 'edit',
            'supports' => array(
                'anchor' => true,
                'align' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // Partner Steps Block
        acf_register_block(array(
            'name' => 'partner-steps-block',
            'title' => __('Partner Steps Block'),
            'description' => __('Partner Steps Block'),
            'category' => 'acf-blocks',
            'icon' => array(
                'background' => '#004ea8',
                'foreground' => '#fff',
                'src' => 'universal-access-alt',
            ),
            'keywords' => array('steps block'),
            'mode' => 'edit',
            'supports' => array(
                'anchor' => true,
                'align' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // Image Full Width
        acf_register_block(array(
            'name' => 'image-full-width',
            'title' => __('Image Full Width'),
            'description' => __('Image Full Width'),
            'category' => 'acf-blocks',
            'icon' => array(
                'background' => '#004ea8',
                'foreground' => '#fff',
                'src' => 'format-image',
            ),
            'keywords' => array('image, full width'),
            'mode' => 'edit',
            'supports' => array(
                'anchor' => true,
                'align' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // Contact Form
        acf_register_block(array(
            'name' => 'contact-form',
            'title' => __('Contact Form'),
            'description' => __('Contact Form'),
            'category' => 'acf-blocks',
            'icon' => array(
                'background' => '#004ea8',
                'foreground' => '#fff',
                'src' => 'editor-help',
            ),
            'keywords' => array('contact, form'),
            'mode' => 'edit',
            'supports' => array(
                'anchor' => true,
                'align' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // Our Stores
        acf_register_block(array(
            'name'            => 'our-stores',
            'title'           => __('Our Stores'),
            'description'     => __('Our Stores.'),
            'category'        => 'acf-blocks',
            'icon' => array(
                'background' => '#004ea8',
                'foreground' => '#fff',
                'src' => 'post-status',
            ),
            'keywords'        => array('store'),
            'mode'            => 'edit',
            'supports'        => array(
                'anchor' => true,
                'align' => false,
                'multiple' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // Featured Brand Block
        acf_register_block(array(
            'name'            => 'featured-brand-block',
            'title'           => __('Featured Brand Block'),
            'description'     => __('Featured Brand Block.'),
            'category'        => 'acf-blocks',
            'icon' => array(
                'background' => '#004ea8',
                'foreground' => '#fff',
                'src' => 'tickets',
            ),
            'keywords'        => array('store'),
            'mode'            => 'edit',
            'supports'        => array(
                'anchor' => true,
                'align' => false,
                'multiple' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // Simple Cards Block 2
        acf_register_block(array(
            'name' => 'simple-cards-block-2',
            'title' => __('Simple Cards Block 2'),
            'description' => __('A custom simple cards block 2 (About page).'),
            'category' => 'acf-blocks',
            'icon' => array(
                'background' => '#004ea8',
                'foreground' => '#fff',
                'src' => 'grid-view',
            ),
            'keywords' => array('cards', 'block 2', 'simple'),
            'post_types' => array('page'),
            'mode' => 'edit',
            'supports' => array(
                'anchor' => true,
                'align' => false,
                'align_text' => true,
                'multiple' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));

        // Contact Address
        acf_register_block(array(
            'name' => 'contact-address',
            'title' => __('Contact Address'),
            'description' => __('A custom contact address.'),
            'category' => 'acf-blocks',
            'icon' => array(
                'background' => '#004ea8',
                'foreground' => '#fff',
                'src' => 'clipboard',
            ),
            'keywords' => array('contact', 'address'),
            'post_types' => array('page'),
            'mode' => 'edit',
            'supports' => array(
                'anchor' => true,
                'align' => false,
                'align_text' => true,
                'multiple' => false,
            ),
            'render_callback' => 'template_acf_block_render_callback',
        ));
    }
}

/**
 * A callback function to output the block's HTML.
 *
 * @param $block
 */
function template_acf_block_render_callback($block, $content = '', $is_preview = false, $post_id = 0)
{
    // Convert name ("acf/hero-block") into path friendly slug ("hero-block")
    $slug = str_replace('acf/', '', $block['name']);

    // Include a template part from within the "template-parts/block" folder
    if (file_exists(get_theme_file_path("/modules/$slug/$slug.php"))) {
        include(get_theme_file_path("/modules/$slug/$slug.php"));
    }
}

/**
 * Heritage Gutenberg Admin Style.
 */
function heritage_gutenberg_admin_styles()
{
    echo '
<style>
	/* Main column width */
	.wp-block {
		max-width: 1920px;
	}

	/* Width of "wide" blocks */
	.wp-block[data-align="wide"] {
		max-width: 1280px;
	}

	/* Width of "full-wide" blocks */
	.wp-block[data-align="full"] {
		max-width: none;
	}
</style>';
}

add_action('admin_head', 'heritage_gutenberg_admin_styles');

/**
 * Modify the path to the icons' directory.
 */
add_filter('acf_icon_path_suffix', function ($path_suffix) {
    return 'dist/images/acf-icons/'; // After dist/ folder you can define folder structure
});

/**
 * Modify the URL to the icons' directory to display on the page.
 */
add_filter('acf_icon_url', function ($path_suffix) {
    return get_stylesheet_directory_uri();
});
