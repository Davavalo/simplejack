<?php
get_header();
?>

<?php
$project_query = new WP_Query(
  array(
    'post_type'       => 'project',
    'posts_per_page'  => -1,
    'meta_key'        => 'completion_year',
    'orderby'         => 'meta_value_num',
    'order'           => 'DESC',
  )
);

$count_posts = wp_count_posts('project');
$published_count = $count_posts->publish;

?>

<section id="work">
  <div class="container">
    <header class="work__header">
      <h2 class="work__title">All Work</h2>
      <p class="work__subtitle">
        (<?php echo esc_html($published_count); ?>)
      </p>
    </header>

    <div class="work__grid">
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

          <a href="<?php the_permalink(); ?>" class="work__item work-hover">

            <span class="work__date">
              <?php echo esc_html($completion_year); ?>
            </span>

            <span class="work__content">

              <span class="work__name">
                <?php the_title(); ?>
              </span>

              <span class="work__description">
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

              <span class="work__tags">

                <?php foreach ((array) $random_keys as $index => $key) : ?>

                  <?php if ($index > 0) : ?>
                    <span class="work__separator">•</span>
                  <?php endif; ?>

                  <span class="work__tag">
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

<?php
get_footer();
