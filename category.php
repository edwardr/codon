<?php
/**
 * The template used for category archives
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package codon
 */

get_header(); ?>

<div class="row">
	<div class="small-12  columns">
		<?php if ( have_posts() ): ?>
		<header class="archive-header">
			<h1 class="page-title">
				<?php echo single_cat_title('<i class="fa fa-archive"></i> '); ?>
			</h1>
		<?php
			// checks for description
			$catdesc = category_description();
				if ( $catdesc != '' ) {
					printf ('<p>' . $catdesc . '</p>');
					}
					?>
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