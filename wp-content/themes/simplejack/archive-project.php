<?php

$count_posts = wp_count_posts('project');
$published_count = $count_posts->publish;

?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>

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

  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
