<?php

$count_posts = wp_count_posts('project');
$published_count = $count_posts->publish;

?>

<?php get_header(); ?>

<section id="work">
  <div class="container">
    <header class="work__header">
      <h2 class="work__title">All Work</h2>
      <?php if (!empty($published_count)) : ?>
        <p class="work__subtitle">
          (<?php echo esc_html($published_count); ?>)
        </p>
      <?php endif; ?>
    </header>
    <?php get_template_part('template-parts/projects/all-projects'); ?>
  </div>
</section>

<?php get_footer(); ?>
