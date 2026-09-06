<?php

function simplejack_scripts()
{
  // The standard stylesheet.
  wp_enqueue_style('simplejack-style', get_template_directory_uri() . '/style.css');

  // The CSS resets
  wp_enqueue_style('simplejack-resets', get_template_directory_uri() . '/assets/css/resets.css');
}
add_action('wp_enqueue_scripts', 'simplejack_scripts');


function remove_wp_block_menu()
{
  remove_submenu_page('themes.php', 'site-editor.php?p=/pattern');
  remove_submenu_page('themes.php', 'font-library.php');
}
add_action('admin_init', 'remove_wp_block_menu');
