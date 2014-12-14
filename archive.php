<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package codon
 */

get_header(); ?>

<div class="row">
	<div class="small-12 columns">
		<?php if ( have_posts() ): ?>
		<header class="archive-header">
			<h1 class="page-title">
			<?php codon_archive_heading();	?>
			</h1>
		</header>
	<?php endif; ?>
	</div>
</div>
		
<?php if( get_theme_mod ('post-display') == 'three-columns' ) {

		get_template_part ('inc/three', 'columns' );

		} elseif

			( get_theme_mod ('post-display') == 'two-columns' ) {

				get_template_part ('inc/two', 'columns' );

				} elseif

					( get_theme_mod ('post-display') == 'blog-style' ) {

						get_template_part ('inc/no', 'columns' );

						}

						?>
<?php get_footer(); ?>