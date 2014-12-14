<?php
/**
 * The template for displaying all single posts.
 *
 * @package codon
 */

get_header(); ?>

<?php if ( get_theme_mod ('post-style') == 'has-sidebar' ) {
		$column = '9';
	} else {
		$column = '12';
	}
	?>

<div class="row content-wrap">
	<div class="small-12 medium-<?php echo $column; ?> columns main-content-area">
		<div class="single-article" role="main">

		<?php while ( have_posts() ) : the_post();
			get_template_part( 'content', 'single' );

			if ( get_theme_mod ('authorbox' ) == 'on' ) {
				codon_authorbox();
			}

			if ( get_theme_mod ('post-navigation') == 'on' ) {
				codon_post_nav();
			}
			?>

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
	// checks for full-width post style
	if ( get_theme_mod ('post-style') == 'has-sidebar' ) {
		get_sidebar('posts');
		}
		?>
</div>
<?php get_footer(); ?>