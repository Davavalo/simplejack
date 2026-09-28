<?php
/**
 * Template Name: About Page
 *
 * @package sj
 */

// Fallback content.
$relevant_skills = array(
	'TypeScript',
	'Astro',
	'React',
	'Figma',
	'Tailwind CSS',
	'Node.js',
);

$about_role = 'Product design & frontend engineering.';

$about_bio = 'I start most projects by trying to find the smallest version of the problem — the one screen, one flow, or one fix that actually matters — and build that first, properly, before expanding outward.

That usually means fewer features than a kickoff deck promises, and more attention to the parts people interact with constantly: load times, empty states, error messages, the things that quietly decide whether software feels good to use.

Outside of client and product work, I maintain a couple of small open-source tools and write occasional notes on what I learn building them.';

$about_resume = get_template_directory_uri() . '/assets/documents/Resume.pdf';

// Override fallback content with ACF values when available.
if ( function_exists( 'get_field' ) ) {
	$acf_skills = get_field( 'relevant_skills' );
	$acf_role   = get_field( 'about_role' );
	$acf_bio    = get_field( 'about_bio' );
	$acf_resume = get_field( 'about_resume' );

	if ( ! empty( $acf_skills ) ) {
		$relevant_skills = array_column( $acf_skills, 'skill' );
	}

	if ( ! empty( $acf_role ) ) {
		$about_role = $acf_role;
	}

	if ( ! empty( $acf_bio ) ) {
		$about_bio = $acf_bio;
	}

	if ( ! empty( $acf_resume['url'] ) ) {
		$about_resume = $acf_resume['url'];
	}
}

get_header();
?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>

		<section id="about">
			<div class="container">

				<p class="page_eyebrow">
					<?php the_title(); ?>
				</p>

				<h1 class="page_title">
					<?php echo esc_html( $about_role ); ?>
				</h1>

				<div class="page_body">
					<?php echo wp_kses_post( wpautop( $about_bio ) ); ?>
				</div>

				<div class="skills">
					<p class="skills__title">Relevant Skills</p>

					<ul class="skills__list">
						<?php foreach ( $relevant_skills as $skill ) : ?>
							<?php if ( ! empty( $skill ) ) : ?>
								<li class="skills__item">
									<?php echo esc_html( $skill ); ?>
								</li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				</div>

				<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="button button--primary">
					Get in Touch
				</a>

				<a
					href="<?php echo esc_url( $about_resume ); ?>"
					class="button button--secondary"
					target="_blank"
					rel="noopener"
				>
					View Resume
				</a>

			</div>
		</section>

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
