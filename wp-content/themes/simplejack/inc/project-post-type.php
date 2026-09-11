<?php

/**
 * Register the Project custom post type.
 */
function register_project_cpt()
{

  $labels = array(
    'name'          => __('Projects', 'simplejack'),
    'singular_name' => __('Project', 'simplejack'),
    'add_new'       => __('Add New', 'simplejack'),
    'add_new_item'  => __('Add New Project', 'simplejack'),
    'edit_item'     => __('Edit Project', 'simplejack'),
    'new_item'      => __('New Project', 'simplejack'),
    'view_item'     => __('View Project', 'simplejack'),
    'view_items'    => __('View Projects', 'simplejack'),
    'search_items'  => __('Search Projects', 'simplejack'),
    'not_found'     => __('No Projects found.', 'simplejack'),
    'all_items'     => __('All Projects', 'simplejack'),
    'menu_name'     => __('Projects', 'simplejack'),
  );

  $args = array(

    'labels' => $labels,

    'description' => __('Organize and manage projects.', 'simplejack'),

    'public'             => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,

    'show_ui'            => true,
    'show_in_menu'       => true,
    'show_in_nav_menus'  => true,
    'show_in_admin_bar'  => true,
    'show_in_rest'       => true,

    'menu_icon' => 'dashicons-portfolio',

    'capability_type' => 'post',

    'supports' => array(
      'title',
      'thumbnail',
      'revisions',
      'editor',
      'custom-fields',
    ),

    'has_archive' => true,

    'rewrite' => array(
      'slug'       => 'work',
      'with_front' => false,
    ),

    'can_export'      => true,
    'delete_with_user' => false,

    'taxonomies' => array('post_tag'),
  );

  register_post_type('project', $args);
}
add_action('init', 'register_project_cpt');

register_post_meta(
  'project',
  'completion_year',
  array(
    'type'         => 'integer',
    'description'  => 'The year the project was completed.',
    'single'       => true,
    'show_in_rest' => true,
  )
);

register_post_meta(
  'project',
  'project_summary',
  array(
    'type'         => 'string',
    'description'  => 'A brief summary of the project.',
    'single'       => true,
    'show_in_rest' => true,
  )
);


/**
 * Add Project Details meta box to the project post type.
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
 * Render the Project Details meta box.
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
 * Save Project Details meta box data.
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

  // Make sure this is a Project.
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
