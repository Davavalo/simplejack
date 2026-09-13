<?php

$current_post = get_post();
// Fetch meta values from that specific page ID
$completion_year = get_post_meta($current_post->ID, 'completion_year', true);

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

    <p class="project__completion-year">
      Completed in <?php echo esc_html($completion_year); ?>
    </p>
  </div>
</section>

<?php
get_footer();
