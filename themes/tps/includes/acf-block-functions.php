<?php
/**
 * Associate the possible block options with the appropriate section.
 *
 * @param array $args Possible arguments.
 */
function heritage_display_block_background_options($args = [])
{
//	$post_id = is_home() ? get_option('page_for_posts', true) : get_the_ID();

	// Get block background options.
	$background_options = get_field('background_options')['background_options'];

	// Setup defaults.
	$defaults = [
		'background_type' => $background_options['background_type'],
		'container'       => 'section',
		'class'           => 'content-block',
		'id'              => '',
	];

	// Parse args.
	$args                    = wp_parse_args($args, $defaults);
	$background_video_markup = $background_image_markup = $pattern_image_markup = '';

	// Only try to get the rest of the settings if the background type is set to anything.
	if ($args['background_type']) {
		if ('color' === $args['background_type'] && $background_options['background_color']['color_picker']) {
			$background_color = $background_options['background_color']['color_picker'];
			$args['class']    .= ' has-background color-as-background bg-' . esc_attr($background_color) . ' has-' . esc_attr($background_color) . '-background-color';
		}

		if ('image' === $args['background_type'] && $background_options['background_image']) {
			$background_image = $background_options['background_image'];
			// Make sure images stay in their containers - relative + overflow hidden.
			$args['class'] .= ' has-background image-as-background relative overflow-hidden';

			ob_start();
			if ($background_options['has_parallax']):
				?>
				<figure class="image-background d-block h-auto w-100 position-absolute" style="background-image:url(<?php echo wp_get_attachment_image_url($background_image, 'full'); ?>);" aria-hidden="true"></figure>
			<?php else: ?>
				<figure class="image-background d-block h-auto w-100 position-absolute" aria-hidden="true">
					<?php echo wp_get_attachment_image($background_image, 'full', false, array('class' => 'h-100 w-100')); ?>
				</figure>
			<?php endif; ?>
			<?php
			$background_image_markup = ob_get_clean();
		}

		if ('video' === $args['background_type'] && !empty($background_options['background_video_mp4'])) {
			$background_video = $background_options['background_video_mp4'];
			// Make sure videos stay in their containers - relative + overflow hidden.
			$args['class'] .= ' has-background video-as-background position-relative overflow-hidden';

			ob_start();
			?>
			<figure class="video-background d-block h-auto w-100 position-absolute">
				<video id="<?php echo esc_attr($args['id']); ?>-video" autoplay muted playsinline loop preload="none">
					<?php if ($background_video['url']) : ?>
						<source src="<?php echo esc_url($background_video['url']); ?>" type="video/mp4">
					<?php endif; ?>
				</video>
			</figure>
			<?php
			$background_video_markup = ob_get_clean();
		}

		if (('image' === $args['background_type'] || 'video' === $args['background_type'])) {
			if ($background_options['has_overlay']) {
				$args['class'] .= ' has-overlay';
				$overlay_color = $background_options['overlay_color']['color_picker'];

				if ('' !== $overlay_color) {
					$args['class'] .= ' has-overlay-color-' . esc_attr($overlay_color);
				}
			}

			if ($background_options['has_parallax']) {
				$args['class'] .= ' has-parallax';
			}

//			if ($background_options['has_pattern']) {
//				$args['class'] .= ' has-pattern';
//
//				$pattern_position = $background_options['pattern_position'] ? : '';
//				ob_start();
//				?>
<!--				<figure class="pattern-image d-block position-absolute --><?php //echo $pattern_position; ?><!--" aria-hidden="true">-->
<!--					--><?php //echo wp_get_attachment_image($background_image, 'full', false, array('class' => 'h-100 w-100')); ?>
<!--				</figure>-->
<!--				--><?php
//				$pattern_image_markup = ob_get_clean();
//			}
		}

		if ('none' === $args['background_type']) {
			$args['class'] .= ' no-background';
		}
	}

	// Print our block container with options.
	printf('<%s id="%s" class="%s">', esc_attr($args['container']), esc_attr($args['id']), esc_attr($args['class']));

	// If we have a background video, echo our background video markup inside the block container.
	if ($background_video_markup) {
		echo $background_video_markup; // WPCS XSS OK.
	}

	// If we have a background image, echo our background image markup inside the block container.
	if ($background_image_markup) {
		echo $background_image_markup; // WPCS XSS OK.
	}

	// If we have a pattern image, echo our pattern image markup inside the block container.
	if ($pattern_image_markup) {
		echo $pattern_image_markup; // WPCS XSS OK.
	}
}

/**
 * Associate the block settings with the appropriate section.
 *
 * @param array $block Block settings.
 *
 * @return array $blockSettings
 */
function get_template_acf_block_settings($block)
{
	// Bail if the $block is not provided.
	if (empty($block)) {
		return [];
	}

	// Setup defaults.
	$defaults = [
		//'full_height'   => '',
		'align_text'    => 'text-left',
		'align_content' => 'justify-content-start align-items-start',
		'heading_color' => '',
		'text_color'    => '',
		//'block_width'   => 'container',
		//'content_width' => 'w-100',
		'animation'     => '',
	];

	$blockSettings = [];

	// Get block display options.
	$display_options = get_field('display_options')['display_options'];

	// Set the custom heading color.
	if ($display_options['heading_color']['color_picker']) {
		$blockSettings['heading_color'] = ' has-heading-color text-' . esc_attr($display_options['heading_color']['color_picker']);
	}

	// Set the custom font color.
	if ($display_options['text_color']['color_picker']) {
		$blockSettings['text_color'] = ' has-text-color text-' . esc_attr($display_options['text_color']['color_picker']);
	}

	// Get animation class.
	$blockSettings['animation'] = heritage_get_animation_class();

	// Set the container width.
//	if (isset($display_options['block_width']) && !empty($display_options['block_width'])) {
//		switch ($display_options['block_width']) {
//			case 'full-width':
//				$blockSettings['block_width'] = 'container ' . esc_attr($display_options['block_width']);
//				break;
//			case 'container-width':
//			default:
//				$blockSettings['block_width'] = 'container';
//				break;
//		}
//	}

//	if (isset($display_options['content_width']) && !empty($display_options['content_width'])) {
//		switch ($display_options['content_width']) {
//			case '4':
//				$blockSettings['content_width'] = 'col-12 col-sm-4';
//				break;
//			case '5':
//				$blockSettings['content_width'] = 'col-12 col-sm-5';
//				break;
//			case '6':
//				$blockSettings['content_width'] = 'col-12 col-sm-6';
//				break;
//			case '7':
//				$blockSettings['content_width'] = 'col-12 col-sm-7';
//				break;
//			case '8':
//				$blockSettings['content_width'] = 'col-12 col-sm-8';
//				break;
//			case '9':
//				$blockSettings['content_width'] = 'col-12 col-sm-9';
//				break;
//			case '10':
//				$blockSettings['content_width'] = 'col-12 col-sm-10';
//				break;
//			case '11':
//				$blockSettings['content_width'] = 'col-12 col-sm-11';
//				break;
//			case 'full':
//			default:
//				$blockSettings['content_width'] = 'col-12';
//				break;
//		}
//	}

//	if (!empty($block['full_height']) && $block['full_height']) {
//		$blockSettings['full_height'] = 'full-height vh-100';
//	}

	if (!empty($block['align_text'])) {
		switch ($block['align_text']) {
			case 'center':
				$blockSettings['align_text'] = 'text-center';
				break;
			case 'right':
				$blockSettings['align_text'] = 'text-end';
				break;
			case 'left':
			default:
				$blockSettings['align_text'] = 'text-start';
				break;
		}
	}

	if (!empty($block['align_content'])) {
		switch ($block['align_content']) {
			case 'top':
				$blockSettings['align_content'] = 'self-start';
				break;
			case 'center':
				$blockSettings['align_content'] = 'self-center';
				break;
			case 'bottom':
				$blockSettings['align_content'] = 'self-end';
				break;
			case 'top left':
				$blockSettings['align_content'] = 'justify-content-start align-items-start';
				break;
			case 'top center':
				$blockSettings['align_content'] = 'justify-content-start align-items-center';
				break;
			case 'top right':
				$blockSettings['align_content'] = 'justify-content-start align-items-end';
				break;
			case 'center left':
				$blockSettings['align_content'] = 'justify-content-center align-items-start';
				break;
			case 'center center':
				$blockSettings['align_content'] = 'justify-content-center align-items-center';
				break;
			case 'center right':
				$blockSettings['align_content'] = 'justify-content-center align-items-end';
				break;
			case 'bottom left':
				$blockSettings['align_content'] = 'justify-content-end align-items-start';
				break;
			case 'bottom center':
				$blockSettings['align_content'] = 'justify-content-end align-items-center';
				break;
			case 'bottom right':
				$blockSettings['align_content'] = 'justify-content-end align-items-end';
				break;
			default:
				$blockSettings['align_content'] = 'justify-content-start align-items-start';
				break;
		}
	}

	// Parse args.
	$blockSettings = wp_parse_args($blockSettings, $defaults);

	return $blockSettings;
}

/**
 * Get the animate.css classes for an element.
 *
 * @return string $classes Animate.css classes for our element.
 */
function heritage_get_animation_class()
{
	// Get block other options for our animation data.
	$display_options = get_field('display_options')['display_options'];

	// Get out of here if we don't have other options.
	if (!$display_options) {
		return '';
	}

	// Set up our animation class for the wrapping element.
	$classes = '';

	// If we have an animation set...
	if ('none' != $display_options['animation']) {
		$classes = ' wow ' . $display_options['animation'];
	}

	return $classes;
}

/**
 * Print block button from the one set in the block content.
 *
 * @param array $button
 *
 * @return string|void Empty string if the button data is not provided, print button otherwise.
 *
 * @author Aivaras Stankevicius <aivaras@bopdesign.com>
 */
function heritage_display_block_button($button)
{
	// Bail if the button is not set.
	if (empty($button)) {
		return '';
	}

	$button_style = $button['button_style'];

	$buttonClass = ('fill' === $button_style) ? 'has-background btn-' . $button['button_color']['color_picker'] : 'is-outlined btn-outline-' . $button['button_color']['color_picker'];

	// Print our block container with options.
	printf('<div class="wp-block-button"><a href="%s" class="custom-btn %s">%s</a></div>', esc_url($button['button']['url']), esc_attr($buttonClass), esc_attr($button['button']['title']));
}

/**
 * Load colors dynamically into select field from heritage_get_theme_colors()
 *
 * @param array $field field options.
 *
 * @return array new field choices.
 *
 * @author Corey Colins <corey@webdevstudios.com>
 */
function heritage_acf_load_color_picker_field_choices($field)
{
	// Reset choices.
	$field['choices'] = [];

	// Grab our colors array.
	$colors = heritage_get_theme_colors();

	// Loop through colors.
	foreach ($colors as $key => $color) {
		// Create display markup.
		$color_output = '<div style="display: flex; align-items: center;"><span style="background-color:' . esc_attr($color) . '; border: 1px solid #ccc;display:inline-block; height: 15px; margin-right: 10px; width: 15px;"></span>' . esc_html($key) . '</div>';

		// Set values.
		$field['choices'][ sanitize_title($key) ] = $color_output;
	}

	// Return the field.
	return $field;
}

add_filter('acf/load_field/name=color_picker', 'heritage_acf_load_color_picker_field_choices');

/**
 * Get the theme colors for this project. Set these first in the Sass partial then migrate them over here.
 *
 * @return array The array of our color names and hex values.
 * @author Corey Collins
 */
function heritage_get_theme_colors()
{
	return [
		esc_html__('Theme Red', 'heritage') => '#ac1c34',
		esc_html__('Theme Dark Blue', 'heritage')     => '#1e3060',
		esc_html__('Theme Blue', 'heritage')          => '#2196f2',
		esc_html__('Theme Light Gray', 'heritage')     => '#b2b3b6',
		esc_html__('Theme Gray', 'heritage')    => '#545759',
		esc_html__('Theme Black', 'heritage') => '#000000',
		esc_html__('Theme White', 'heritage')        => '#cccccc',
		esc_html__('White', 'heritage')    => '#ffffff',
	];
}
