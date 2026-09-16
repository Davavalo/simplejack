<?php

$current_post = get_post();
// Fetch meta values from that specific page ID
$completion_year = get_post_meta($current_post->ID, 'completion_year', true);
$project_summary = get_post_meta($current_post->ID, 'project_summary', true);

?>

<?php
get_header();

?>
<section id="project">
  <div class="container">
    <a href="<?php echo esc_url(home_url('/work')); ?>" class="project__back-link">
      &larr; All Work</a>
    <h1 class="project__title">
      <?php the_title(); ?>
    </h1>
    <p>
      <?php echo esc_html($project_summary); ?>
    </p>
  </div>
</section>

<?php
get_footer();
