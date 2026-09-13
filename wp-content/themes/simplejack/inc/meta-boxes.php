<?php

/**
 * Add hero settings meta box to the front page.
 */
function add_homepage_hero_meta_box()
{
  // Check if we are on the front page
  $front_page_id = (int) get_option('page_on_front');

  // Check if we are editing the front page
  $current_post_id = isset($_GET['post']) ? (int) $_GET['post'] : 0;

  // If we are not on the front page or not editing the front page, return
  if (!$front_page_id || $current_post_id !== $front_page_id) {
    return;
  }

  add_meta_box(
    'hero_settings_meta_box',
    'Hero Section Details',
    'render_hero_settings_meta_box',
    'page',
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'add_homepage_hero_meta_box');

/**
 * Creates the custom fields and renders the hero settings meta box.
 */
function render_hero_settings_meta_box($post)
{
  wp_nonce_field(
    'save_hero_settings',
    'hero_settings_nonce'
  );

  $role = get_post_meta($post->ID, 'current_role', true) ?: '';
  $job = get_post_meta($post->ID, 'current_job', true) ?: '';
  $location = get_post_meta($post->ID, 'current_location', true) ?: '';
?>

  <div class="hero-meta-field">
    <label for="current_role">
      <strong>Current Role</strong>
    </label>

    <input
      type="text"
      id="current_role"
      name="current_role"
      value="<?php echo esc_attr($role); ?>"
      class="widefat">

    <p class="description">
      e.g., Art Director, Lead Designer
    </p>
  </div>

  <div class="hero-meta-field">
    <label for="current_job">
      <strong>Current Company</strong>
    </label>

    <input
      type="text"
      id="current_job"
      name="current_job"
      value="<?php echo esc_attr($job); ?>"
      class="widefat">

    <p class="description">
      e.g., Google
    </p>
  </div>

  <div class="hero-meta-field">
    <label for="current_location">
      <strong>Current Location</strong>
    </label>

    <input
      type="text"
      id="current_location"
      name="current_location"
      value="<?php echo esc_attr($location); ?>"
      class="widefat">

    <p class="description">
      e.g., Kansas City, MO
    </p>
  </div>

<?php
}


/**
 * Save hero settings meta box data.
 */
function save_homepage_hero_meta($post_id)
{
  // Check if the nonce is set and valid
  if (
    !isset($_POST['hero_settings_nonce']) ||
    !wp_verify_nonce(
      wp_unslash($_POST['hero_settings_nonce']),
      'save_hero_settings'
    )
  ) {
    return;
  }

  // Check if this is a revision or autosave
  if (
    wp_is_post_revision($post_id) ||
    wp_is_post_autosave($post_id)
  ) {
    return;
  }

  // Check if the post type is 'page'
  if (get_post_type($post_id) !== 'page') {
    return;
  }

  // Check if this is the front page
  if ((int) get_option('page_on_front') !== (int) $post_id) {
    return;
  }

  // Check if the user can edit the page
  if (!current_user_can('edit_page', $post_id)) {
    return;
  }

  $fields = [
    'current_role',
    'current_job',
    'current_location',
  ];

  foreach ($fields as $field) {
    if (isset($_POST[$field])) {
      update_post_meta(
        $post_id,
        $field,
        sanitize_text_field(
          wp_unslash($_POST[$field])
        )
      );
    }
  }
}
add_action('save_post', 'save_homepage_hero_meta');



/**
 * Add project details meta box to the project post type containing custom fields.
 */
function add_project_cpt_meta_box()
{

  add_meta_box(
    'project_cpt_meta_box',
    'Project Details',
    'render_project_cpt_meta_box',
    'project',
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'add_project_cpt_meta_box');


/**
 * Render the project details meta box with custom field data.
 */
function render_project_cpt_meta_box($post)
{
  wp_nonce_field(
    'save_project_cpt_settings',
    'project_cpt_settings_nonce'
  );

  $year = get_post_meta($post->ID, 'completion_year', true) ?: '';
  $summary = get_post_meta($post->ID, 'project_summary', true) ?: '';
?>

  <div class="project-meta-field">
    <label for="completion_year">
      <strong>Completion year</strong>
    </label>

    <input
      type="number"
      id="completion_year"
      name="completion_year"
      value="<?php echo esc_attr($year); ?>"
      class="widefat">

    <p class="description">
      The year the project was completed.
    </p>
  </div>

  <div class="project-meta-field">
    <label for="project_summary">
      <strong>Project Summary</strong>
    </label>

    <textarea
      id="project_summary"
      name="project_summary"
      rows="6"
      class="widefat"><?php echo esc_textarea(trim($summary)); ?></textarea>

    <p class="description">
      A brief summary of the project.
    </p>
  </div>

<?php
}


/**
 * Save project details meta box data.
 */
function save_project_cpt_meta($post_id)
{

  // Verify nonce.
  if (
    !isset($_POST['project_cpt_settings_nonce']) ||
    !wp_verify_nonce(
      wp_unslash($_POST['project_cpt_settings_nonce']),
      'save_project_cpt_settings'
    )
  ) {
    return;
  }

  // Ignore autosaves and revisions.
  if (
    wp_is_post_autosave($post_id) ||
    wp_is_post_revision($post_id)
  ) {
    return;
  }

  // Make sure this is a project.
  if (get_post_type($post_id) !== 'project') {
    return;
  }

  // Make sure the current user can edit this post.
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // Save completion year.
  if (isset($_POST['completion_year'])) {
    update_post_meta(
      $post_id,
      'completion_year',
      absint(
        wp_unslash($_POST['completion_year'])
      )
    );
  }

  // Save project summary
  if (isset($_POST['project_summary'])) {
    update_post_meta(
      $post_id,
      'project_summary',
      sanitize_text_field(
        wp_unslash($_POST['project_summary'])
      )
    );
  }
}
add_action('save_post', 'save_project_cpt_meta');
