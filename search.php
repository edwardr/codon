<?php
/**
 * The template for displaying search results pages.
 *
 * @package codon
 */

get_header(); ?>

	<div class="row">
		<div class="small-12 columns">
			<?php if ( have_posts() ): ?>
			<header id="archive-header">
				<h1 class="page-title">
				<i class="fa fa-search"></i>
				<?php printf( _e( 'Search Results for: ', 'codon' ) );
						echo get_search_query();
							?>
				</h1>
			</header>
		<?php else : ?>
		<header id="archive-header">
			<h1 class="page-title">
			<i class="fa fa-search"></i>
			<?php printf( _e( 'No results found for: ', 'codon' ) );
					echo get_search_query();
						?>
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