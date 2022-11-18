<?php
// set up the theme
function ela_setup() {
	load_theme_textdomain( 'ela', get_template_directory() . '/languages' );

	// Theme support
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	// Gutenberg elements
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'widgets-block-editor' );

	// include image size
	require get_template_directory() . '/inc/image-size.php';

	// Set the default content width.
	$GLOBALS['content_width'] = 880;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top' => esc_attr__( 'Top Menu', 'ela' ),
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support( 'post-formats', array(
		'image',
		'video',
		'gallery',
		'audio',
		'status',
		'aside'
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	// Add editor style
	add_editor_style( array( 'assets/css/editor-style.css', ela_custom_fonts_url(), 'assets/css/customstyle.css' ) );
}

add_action( 'after_setup_theme', 'ela_setup' );

// Enqueue style and scripts
require get_template_directory() . '/inc/enqueue.php';
// Sidebars
require get_template_directory() . '/inc/sidebars.php';
// Required template tags
require get_template_directory() . '/inc/template_functions.php';
// Filter hooks
require get_template_directory() . '/inc/hook_actions.php';
// Nav menu walker
require get_template_directory() . '/inc/nav_menu_walker.php';
// TGMPA plugin activation
require get_template_directory() . '/inc/tgmpa.php';

