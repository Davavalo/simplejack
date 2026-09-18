<?php get_header(); ?>

<section id="project">
  <div class="container">

    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>

        <a
          href="<?php echo esc_url(home_url('/work')); ?>"
          class="project__back-link">
          &larr; All Work
        </a>

        <h1 class="project__title">
          <?php the_title(); ?>
        </h1>

        <?php
        $completion_year = get_post_meta(get_the_ID(), 'completion_year', true);
        $project_summary = get_post_meta(get_the_ID(), 'project_summary', true);
        $project_tags = get_the_terms(get_the_ID(), 'post_tag');
        ?>

        <dl class="project__details">
          <?php if (!empty($completion_year)) : ?>
            <dt>Completion Year:</dt>
            <dd><?php echo esc_html($completion_year); ?></dd>
          <?php endif; ?>
        </dl>

        <?php if (!empty($project_summary)) : ?>
          <p>
            <?php echo esc_html($project_summary); ?>
          </p>
        <?php endif; ?>

      <?php endwhile; ?>
    <?php endif; ?>

  </div>
</section>

<?php get_footer(); ?>
