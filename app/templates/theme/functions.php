<?php
/**
 * <%= ThemeFolder %> functions and definitions
 *
 * @package <%= ThemeName %>
 */

if ( ! function_exists( '<%= ThemeUnderscores %>_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function <%= ThemeUnderscores %>_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on <%= ThemeFolder %>, use a find and replace
	 * to change '<%= ThemeFolder %>' to the name of your theme in all the template files
	 */
	load_theme_textdomain( '<%= ThemeFolder %>', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', '<%= ThemeFolder %>' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( '<%= ThemeUnderscores %>_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // <%= ThemeUnderscores %>_setup
add_action( 'after_setup_theme', '<%= ThemeUnderscores %>_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function <%= ThemeUnderscores %>_content_width() {
	$GLOBALS['content_width'] = apply_filters( '<%= ThemeUnderscores %>_content_width', 640 );
}
add_action( 'after_setup_theme', '<%= ThemeUnderscores %>_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function <%= ThemeUnderscores %>_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Home', '<%= ThemeFolder %>' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

  register_sidebar([
    'name'          => __('Footer', '<%= ThemeFolder %>'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s col-xs-12 col-md-6 col-lg-7">',
    'after_widget'  => '</section>',
    'before_title'  => '<h1>',
    'after_title'   => '</h1>'
  ]);
}
add_action( 'widgets_init', '<%= ThemeUnderscores %>_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function <%= ThemeUnderscores %>_scripts() {
	wp_enqueue_style( '<%= ThemeFolder %>-style', get_template_directory_uri() . '/assets/styles/main.css', array(), '20160101' );

	wp_enqueue_script( '<%= ThemeFolder %>-navigation', get_template_directory_uri() . '/assets/scripts/main.js', array(), '20160101', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '<%= ThemeUnderscores %>_scripts' );

// add_filter('widget_title', 'new_title', 99);
// function new_title($title) {
//     $title = 'text';
//     return $title;
// }

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

// Register Custom Navigation Walker
require_once(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');