<?php
/**
 * The template used for the author archive
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
				<i class="fa fa-user"></i> 
				<?php echo get_the_author(); ?>
			</h1>
		</header>
	<?php 
		// retrives the author box
			codon_authorbox();
			endif; 
			?>
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