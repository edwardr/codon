<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package codon
 */

get_header(); ?>

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
