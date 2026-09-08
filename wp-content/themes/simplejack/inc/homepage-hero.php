<?php

/**
 * Hide the main WYSIWYG content editor on the front page.
 */

function remove_homepage_editor()
{
  $screen = get_current_screen();
  if (!$screen || $screen->base !== 'post') {
    return;
  }

  $post_id       = get_the_ID();
  $front_page_id = (int) get_option('page_on_front');

  if ($post_id && $post_id === $front_page_id) {
    remove_post_type_support('page', 'editor');
    remove_meta_box('postcustom', 'page', 'normal');
  }
}
add_action('admin_head', 'remove_homepage_editor');


/**
 * Pre-populate default custom fields when first opening or saving the front page.
 * re-populate fields if they are empty.
 */

function prepopulate_front_page_fields()
{
  $front_page_id = (int) get_option('page_on_front');
  if (!$front_page_id) {
    return;
  }

  $defaults = [
    'current_role'     => 'My Current Role',
    'current_job'      => 'My Current Job',
    'current_location' => 'My Current Location'
  ];

  foreach ($defaults as $meta_key => $default_value) {
    // If meta field doesn't exist yet, create it with default value
    if (get_post_meta($front_page_id, $meta_key, true) === '') {
      update_post_meta($front_page_id, $meta_key, $default_value);
    }
  }
}
add_action('admin_init', 'prepopulate_front_page_fields');


/**
 * 1. Add Custom Meta Box to Homepage
 */
add_action('add_meta_boxes', function () {
  $front_page_id = (int) get_option('page_on_front');
  $current_screen_post = isset($_GET['post']) ? (int) $_GET['post'] : 0;

  // Only display on the designated Front Page
  if ($front_page_id && $current_screen_post === $front_page_id) {
    add_meta_box(
      'hero_settings_meta_box',         // Unique Box ID
      'Hero Section Details',           // Box Title
      'render_hero_settings_meta_box',  // Callback function
      'page',                           // Post type
      'normal',                         // Context (main column)
      'high'                            // Priority
    );
  }
});

/**
 * 2. Render the Styled Meta Box HTML
 */
function render_hero_settings_meta_box($post)
{
  // Add nonce for security
  wp_nonce_field('save_hero_settings', 'hero_settings_nonce');

  // Retrieve current values
  $role     = get_post_meta($post->ID, 'current_role', true) ?: 'My Current Role';
  $job      = get_post_meta($post->ID, 'current_job', true) ?: 'My Current Job';
  $location = get_post_meta($post->ID, 'current_location', true) ?: 'My Current Location';
?>
  <style>
    .hero-meta-field {
      margin-bottom: 15px;
    }

    .hero-meta-field:last-child {
      margin-bottom: 0;
    }

    .hero-meta-field label {
      display: block;
      font-weight: 600;
      margin-bottom: 5px;
    }

    .hero-meta-field input[type="text"] {
      width: 100%;
      max-width: 500px;
      padding: 6px 10px;
    }

    .hero-meta-field .description {
      color: #666;
      font-size: 12px;
      margin-top: 3px;
    }
  </style>

  <div class="hero-meta-field">
    <label for="current_role">Current Role</label>
    <input type="text" id="current_role" name="current_role" value="<?php echo esc_attr($role); ?>">
    <p class="description">e.g., Art Director, Lead Designer</p>
  </div>

  <div class="hero-meta-field">
    <label for="current_job">Current Company</label>
    <input type="text" id="current_job" name="current_job" value="<?php echo esc_attr($job); ?>">
    <p class="description">e.g., Google</p>
  </div>

  <div class="hero-meta-field">
    <label for="current_location">Current Location</label>
    <input type="text" id="current_location" name="current_location" value="<?php echo esc_attr($location); ?>">
    <p class="description">e.g., Kansas City, MO</p>
  </div>
<?php
}

/**
 * 3. Save the Field Data
 */
add_action('save_post', function ($post_id) {
  // Check security nonce
  if (!isset($_POST['hero_settings_nonce']) || !wp_verify_nonce($_POST['hero_settings_nonce'], 'save_hero_settings')) {
    return;
  }

  // Stop autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // Check user permissions
  if (!current_user_can('edit_page', $post_id)) {
    return;
  }

  // Save or update meta values
  $fields = ['current_role', 'current_job', 'current_location'];
  foreach ($fields as $field) {
    if (isset($_POST[$field])) {
      update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
    }
  }
});
