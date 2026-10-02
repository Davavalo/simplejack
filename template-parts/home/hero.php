<?php
/**
 * The hero section for the homepage.
 *
 * @package simplejack
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get Urls for Work and Contact Pages.
$work_page    = get_page_by_path( 'work' );
$contact_page = get_page_by_path( 'contact' );

$work_url    = $work_page ? get_permalink( $work_page ) : home_url( '/work/' );
$contact_url = $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' );


// Fallback content.
	$current_location = 'New York, NY';
	$current_job      = 'Slant';
	$current_role     = 'Software Developer';
	$hero_title       = 'I design and build interfaces that hold up under real use.';
	$hero_description = 'Product design & frontend engineering — based on the work below, not a list of buzzwords.';

// Override fallback content with ACF values when available.
if ( function_exists( 'get_field' ) ) {
	$acf_current_location = get_field( 'current_location' );
	$acf_current_job      = get_field( 'current_job' );
	$acf_current_role     = get_field( 'current_role' );
	$acf_hero_title       = get_field( 'hero_title' );
	$acf_hero_description = get_field( 'hero_description' );

	if ( null !== $acf_current_location ) {
		$current_location = $acf_current_location;
	}

	if ( null !== $acf_current_job ) {
		$current_job = $acf_current_job;
	}

	if ( null !== $acf_current_role ) {
		$current_role = $acf_current_role;
	}

	if ( ! empty( $acf_hero_title ) ) {
		$hero_title = $acf_hero_title;
	}

	if ( ! empty( $acf_hero_description ) ) {
		$hero_description = $acf_hero_description;
	}
}

$hero_subtitle = '';

if ( $current_job && $current_role && $current_location ) {

	$hero_subtitle = sprintf(
		'%s at %s. Located in %s.',
		$current_role,
		$current_job,
		$current_location
	);

} elseif ( $current_job && $current_role ) {

	$hero_subtitle = sprintf(
		'%s at %s.',
		$current_role,
		$current_job
	);

} elseif ( $current_job && $current_location ) {

	$hero_subtitle = sprintf(
		'Currently at %s. Located in %s.',
		$current_job,
		$current_location
	);

} elseif ( $current_role && $current_location ) {

	$hero_subtitle = sprintf(
		'%s. Located in %s.',
		$current_role,
		$current_location
	);

} elseif ( $current_job ) {

	$hero_subtitle = sprintf(
		'Currently at %s',
		$current_job
	);

} elseif ( $current_role ) {

	$hero_subtitle = $current_role;

} elseif ( $current_location ) {

	$hero_subtitle = sprintf(
		'Located in %s',
		$current_location
	);
}
?>

<section id="hero">
	<div class="container">

		<p class="hero__subtitle">
			<?php echo esc_html( $hero_subtitle ); ?>
		</p>

		<h2 class="hero__title">
			<?php echo esc_html( $hero_title ); ?>
		</h2>

		<p class="hero__description">
			<?php echo esc_html( $hero_description ); ?>
		</p>

		<div class="hero__cta">
			<a href="/work" class="button button--primary">View the Work &rarr;</a>
			<a href="/contact" class="button button--secondary">Get in Touch</a>
		</div>

	</div>
</section>
