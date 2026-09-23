<?php

// Fetch meta values from ACF fields on the front page
$current_location = get_field('current_location');
$current_job      = get_field('current_job');
$current_role     = get_field('current_role');
$hero_title       = get_field('hero_title');
$hero_description = get_field('hero_description');

$hero_meta = [];

if ($current_job && $current_role) {
  $hero_values[] = sprintf('%s at %s', $current_role, $current_job);
} elseif ($current_job) {
  $hero_values[] = sprintf('Currently at %s', $current_job);
} elseif ($current_role) {
  $hero_values[] = $current_role;
}

if ($current_location) {
  $hero_values[] = sprintf("in %s", $current_location);
}
?>

<section id="hero">
  <div class="container">
    <?php if (!empty($hero_values)) : ?>

      <ul class="hero__subtitle">
        <?php foreach ($hero_values as $value) : ?>
          <li><?php echo esc_html($value); ?></li>
        <?php endforeach; ?>
      </ul>

    <?php else: ?>

      <ul class="hero__subtitle">
        <li>Currently building at Studio Co</li>
        <li>· open to new work, Q3 2026</li>
      </ul>

    <?php endif; ?>

    <?php if (!empty($hero_title)) : ?>
      <h2 class="hero__title">
        <?php echo esc_html($hero_title) ?>
      </h2>
    <?php else: ?>
      <h2 class="hero__title">
        I design and build interfaces that hold up under real use.
      </h2>
    <?php endif; ?>

    <?php if (!empty($hero_description)) : ?>
      <p class="hero__description">
        <?php echo esc_html($hero_description) ?>
      </p>
    <?php else: ?>
      <p class="hero__description">
        Product design & frontend engineering — based on the work below, not a list of buzzwords.
      </p>
    <?php endif; ?>

    <div class="hero__cta">
      <a href="/work" class="button button--primary">View the Work &rarr;</a>
      <a href="/contact" class="button button--secondary">Get in Touch</a>
    </div>
  </div>
</section>
