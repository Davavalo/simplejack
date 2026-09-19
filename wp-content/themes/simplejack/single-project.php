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

        <?php
        if (has_post_thumbnail()) {
          the_post_thumbnail(
            'full',
            array('class' => 'project__image')
          );
        }
        ?>

        <h1 class="project__title">
          <?php the_title(); ?>
        </h1>

        <?php
        $completion_year = get_field('completion_year');
        $project_summary = get_field('project_summary');
        $project_role = get_field('project_role');
        $project_tags = get_the_terms(get_the_ID(), 'post_tag');
        ?>

        <dl class="project__details">

          <?php if (!empty($completion_year)) : ?>
            <div class="project__detail">
              <dt class="inline">Date Completed:</dt>
              <dd class="inline"><?php echo esc_html($completion_year); ?></dd>
            </div>
          <?php endif; ?>

          <?php if (!empty($project_tags)) : ?>
            <div class="project__detail">
              <dt class="inline">Skills:</dt>
              <dd class="inline">
                <?php
                $tag_names = array();
                foreach ($project_tags as $tag) {
                  $tag_names[] = esc_html($tag->name);
                }
                echo implode(', ', $tag_names);
                ?>
              </dd>
            </div>
          <?php endif; ?>

          <?php if (!empty($project_role)) : ?>
            <div class="project__detail">
              <dt class="inline">My Role:</dt>
              <dd class="inline"><?php echo esc_html($project_role); ?></dd>
            </div>
          <?php endif; ?>

        </dl>
        <div class="project__article">
          <?php if (!empty($project_summary)) : ?>
            <p>
              <?php echo esc_html($project_summary); ?>
            </p>
          <?php endif; ?>
        </div>

      <?php endwhile; ?>
    <?php endif; ?>

  </div>
</section>

<?php get_footer(); ?>
