<?php
/**
 * The template for displaying all single posts.
 *
 * @package sj
 */

get_header();
?>

<section id="post">
	<div class="container">

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

			</article>

			<?php
		endwhile;
		?>

	</div>
</section>

<?php
get_footer();
