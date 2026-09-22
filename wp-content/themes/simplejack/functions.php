<?php

// Exit if accessed directly to prevent malicious execution
if (!defined('ABSPATH')) {
  exit;
}

function simplejack_scripts()
{
  // The standard stylesheet.
  wp_enqueue_style('simplejack-style', get_stylesheet_uri());

  // The CSS resets.
  wp_enqueue_style('simplejack-resets', get_theme_file_uri('/assets/css/resets.css'));

  // The CSS styles.
  wp_enqueue_style('simplejack-components', get_theme_file_uri('/assets/css/components.css'));
  wp_enqueue_style('simplejack-globals', get_theme_file_uri('/assets/css/globals.css'));
  wp_enqueue_style('simplejack-pages', get_theme_file_uri('/assets/css/pages.css'));
}
add_action('wp_enqueue_scripts', 'simplejack_scripts');


function remove_wp_block_menu()
{
  // Remove WP Block Editor menu items, specifically the pattern and font library menus.
  remove_submenu_page('themes.php', 'site-editor.php?p=/pattern');
  remove_submenu_page('themes.php', 'font-library.php');
}
add_action('admin_init', 'remove_wp_block_menu');

if (! function_exists('simplejack_setup')) {

  /**
   * Sets up theme defaults and registers support for various WordPress features.
   */

  function simplejack_setup()
  {
    /*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
    add_theme_support('title-tag');

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
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1920, 9999);

    // Register the default menu locations.
    register_nav_menus(
      array(
        'primary' => esc_html__('Primary menu', 'simplejack'),
        'footer'  => esc_html__('Footer menu', 'simplejack'),
      )
    );

    /*
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

    /*
		 * Add support for core custom logo.
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
    add_theme_support(
      'custom-logo',
      array(
        'flex-width'           => true,
        'flex-height'          => true
      )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for responsive embedded content.
    add_theme_support('responsive-embeds');

    // Remove feed icon link from legacy RSS widget.
    add_filter('rss_widget_feed_link', '__return_empty_string');
  }

  // // Add starter content to the theme
  // require get_template_directory() . '/inc/starter-content.php';
  // add_theme_support('starter-content', simple_jack_get_starter_content());
}
add_action('after_setup_theme', 'simplejack_setup');


/**
 * Add a custom class to menu links.
 *
 * Use the `link_class` argument with wp_nav_menu().
 */
function add_menu_link_class($atts, $_item, $args)
{
  if (! empty($args->link_class)) {
    $atts['class'] = trim(
      ($atts['class'] ?? '') . ' ' . $args->link_class
    );
  }

  return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 10, 3);


// Homepage Hero settings
require_once get_template_directory() . '/inc/homepage-hero.php';


// Project post type
require_once get_template_directory() . '/inc/project-post-type.php';

// Meta boxes
require_once get_template_directory() . '/inc/meta-boxes.php';

// Contact form
require_once get_template_directory() . '/template-parts/contact/contact-form.php';
