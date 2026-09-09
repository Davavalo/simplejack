<?php

$project_query = new WP_Query(
  array(
    'post_type'       => 'project',
    'posts_per_page'  => 3,
    'meta_key'        => 'completion_year',
    'orderby'         => 'meta_value_num',
    'order'           => 'DESC',
  )
);

?>

<section id="recent-work">
  <div class="container">
    <header class="recent-work__header">
      <h2 class="recent-work__title">Recent Work</h2>
      <p class="recent-work__subtitle">
        Here's what I've been working on lately.
      </p>
    </header>

    <div class="recent-work__grid">
      <?php if ($project_query->have_posts()) : ?>
        <?php while ($project_query->have_posts()) : $project_query->the_post(); ?>

          <?php
          $project_tags = get_the_tags();


          $completion_year = get_post_meta(
            get_the_ID(),
            'completion_year',
            true
          );

          $project_summary = get_post_meta(
            get_the_ID(),
            'project_summary',
            true
          );
          ?>

          <a href="<?php the_permalink(); ?>" class="recent-work__item work-hover">

            <span class="recent-work__date">
              <?php echo esc_html($completion_year); ?>
            </span>

            <span class="recent-work__content">

              <span class="recent-work__name">
                <?php the_title(); ?>
              </span>

              <span class="recent-work__description">
                <?php echo esc_html($project_summary); ?>
              </span>

            </span>

            <?php

            if ($project_tags) :

              $random_keys = array_rand(
                $project_tags,
                min(2, count($project_tags))
              );

            ?>

              <span class="recent-work__tags">

                <?php foreach ((array) $random_keys as $index => $key) : ?>

                  <?php if ($index > 0) : ?>
                    <span class="recent-work__separator">•</span>
                  <?php endif; ?>

                  <span class="recent-work__tag">
                    <?php echo esc_html($project_tags[$key]->name); ?>
                  </span>

                <?php endforeach; ?>

              </span>

            <?php endif; ?>


          </a>

        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>
    </div>
  </div>
</section>
