<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package <%= ThemeName %>
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function <%= ThemeUnderscores %>_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => '<%= ThemeUnderscores %>_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function <%= ThemeUnderscores %>_jetpack_setup
add_action( 'after_setup_theme', '<%= ThemeUnderscores %>_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function <%= ThemeUnderscores %>_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function <%= ThemeUnderscores %>_infinite_scroll_render
