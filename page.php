<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package codon
 */

get_header(); ?>

<div class="row content-wrap">
	<div class="small-12 medium-9 columns main-content-area">
		<div class="single-article" role="main">
			<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

	</div>
</div>
<?php 
	if ( is_front_page() ) {
		get_sidebar('home');
	} else {
		get_sidebar();
	}
?>
</div>
<?php get_footer(); ?>
