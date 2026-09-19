<?php


?>

<?php get_header(); ?>


<section id="work">
  <div class="container">
    <header class="work__header">
      <h2 class="work__title">All Work</h2>
      <p class="work__subtitle">
        A collection of all my work.
      </p>
    </header>
    <?php get_template_part('template-parts/projects/all-projects'); ?>
  </div>
</section>

<?php get_footer(); ?>
