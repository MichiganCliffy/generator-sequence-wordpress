<?php
/**
 * The template for displaying all single posts.
 *
 * @package <%= ThemeName %>
 */

get_header(); ?>

<?php get_sidebar(); ?>

	<main class="content-area col-md-8 col-md-pull-4" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

	</main><!-- .content-area -->

<?php get_footer(); ?>
