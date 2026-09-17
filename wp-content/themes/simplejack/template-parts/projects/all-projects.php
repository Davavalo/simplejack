<?php
$project_query = new WP_Query([
  'post_type'      => 'project',
  'posts_per_page' => -1,
  'meta_key'       => 'completion_year',
  'orderby'        => 'meta_value_num',
  'order'          => 'DESC',
]);

?>

<div class="work__grid">
  <?php if ($project_query->have_posts()) : ?>
    <?php while ($project_query->have_posts()) : $project_query->the_post(); ?>

      <?php
      $completion_year = get_field('completion_year');
      $project_summary = get_field('project_summary');
      $project_tags    = get_the_terms(get_the_ID(), 'post_tag');
      ?>

      <a href="<?php the_permalink(); ?>" class="work__item work-hover">

        <?php if (!empty($completion_year)) : ?>
          <span class="work__date">
            <?php echo esc_html($completion_year); ?>
          </span>
        <?php endif; ?>

        <span class="work__content">

          <span class="work__name">
            <?php the_title(); ?>
          </span>

          <?php if (!empty($project_summary)) : ?>
            <span class="work__description">
              <?php echo esc_html($project_summary); ?>
            </span>
          <?php endif; ?>

        </span>

        <?php if (!is_wp_error($project_tags) && !empty($project_tags)) :

          shuffle($project_tags);
          $random_tags = array_slice($project_tags, 0, 2);

        ?>

          <span class="work__tags">
            <?php foreach ($random_tags as $index => $tag) : ?>
              <?php if ($index > 0) : ?>
                <span
                  class="work__separator"
                  aria-hidden="true">•</span>
              <?php endif; ?>

              <span class="work__tag">
                <?php echo esc_html($tag->name); ?>
              </span>
            <?php endforeach; ?>
          </span>

        <?php endif; ?>
      </a>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>
</div>
