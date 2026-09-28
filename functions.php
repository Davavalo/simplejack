<?php
/**
 * Simple Jack theme functions and definitions.
 *
 * @package sj
 */

// Exit if accessed directly to prevent malicious execution.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue theme stylesheets.
 *
 * @return void
 */
function simplejack_scripts() {
	wp_enqueue_style(
		'simplejack-style',
		get_stylesheet_uri(),
		array(),
		filemtime( get_stylesheet_directory() . '/style.css' )
	);

	wp_enqueue_style(
		'simplejack-resets',
		get_theme_file_uri( '/assets/css/resets.css' ),
		array(),
		filemtime( get_theme_file_path( '/assets/css/resets.css' ) )
	);

	wp_enqueue_style(
		'simplejack-components',
		get_theme_file_uri( '/assets/css/components.css' ),
		array(),
		filemtime( get_theme_file_path( '/assets/css/components.css' ) )
	);

	wp_enqueue_style(
		'simplejack-globals',
		get_theme_file_uri( '/assets/css/globals.css' ),
		array(),
		filemtime( get_theme_file_path( '/assets/css/globals.css' ) )
	);

	wp_enqueue_style(
		'simplejack-pages',
		get_theme_file_uri( '/assets/css/pages.css' ),
		array(),
		filemtime( get_theme_file_path( '/assets/css/pages.css' ) )
	);
}
add_action( 'wp_enqueue_scripts', 'simplejack_scripts' );

/**
 * Remove unnecessary WordPress block editor menu items.
 *
 * @return void
 */
function remove_wp_block_menu() {
	// Remove the pattern and font library menus.
	remove_submenu_page( 'themes.php', 'site-editor.php?p=/pattern' );
	remove_submenu_page( 'themes.php', 'font-library.php' );
}
add_action( 'admin_init', 'remove_wp_block_menu' );

if ( ! function_exists( 'simplejack_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @return void
	 */
	function simplejack_setup() {
		/**
		 * Let WordPress manage the document title.
		 *
		 * This theme does not use a hard-coded <title> tag in the document head.
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Add post-formats support.
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		// Add support for post thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size();

		// Register the default menu locations.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'simplejack' ),
				'footer'  => esc_html__( 'Footer menu', 'simplejack' ),
			)
		);

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/**
		 * Add support for core custom logo.
		 */
		add_theme_support(
			'custom-logo',
			array(
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove the feed icon link from the legacy RSS widget.
		add_filter( 'rss_widget_feed_link', '__return_empty_string' );
	}
}
add_action( 'after_setup_theme', 'simplejack_setup' );

/**
 * Add a custom class to menu links.
 *
 * Use the `link_class` argument with wp_nav_menu().
 *
 * @param array    $atts  The HTML attributes applied to the menu item's anchor element.
 * @param WP_Post  $_item The current menu item object.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @return array
 */
function add_menu_link_class( $atts, $_item, $args ) {
	if ( ! empty( $args->link_class ) ) {
		$atts['class'] = trim(
			( $atts['class'] ?? '' ) . ' ' . $args->link_class
		);
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 10, 3 );

// Load the contact form.
require_once get_template_directory() . '/template-parts/contact/contact-form.php';

// Load theme setup dependencies and configuration.
require_once get_template_directory() . '/inc/plugin-dependencies.php';
require_once get_template_directory() . '/inc/register-acf-custom-post.php';
require_once get_template_directory() . '/inc/starter-content.php';
require_once get_template_directory() . '/inc/theme-setup.php';
