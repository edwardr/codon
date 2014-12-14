<?php 
/**
 * blog style archive display
 * used on all archives if blog style layout is selected
 * @package codon
 */
 ?>
<?php if ( get_theme_mod ('archive-post-sidebar' ) == 'on' ) {
	$column_class = 'medium-9';
	} else {
	$column_class = null;
	}
	?>
<div class="row">
	<div class="small-12 <?php echo $column_class; ?> columns">
		<div id="content">
			<?php
				if ( is_front_page() ) {
					do_action ('codon_before_home_content');
					}
					?>
			<?php if (have_posts()) : ?>
				<ul class="small-block-grid-1 column-posts no-column-posts main-content-area">
				<?php while (have_posts()) : the_post(); ?>
					<li class="column-post-li">
						<?php get_template_part ('content', 'archive' ); ?>
					</li>
			<?php endwhile; ?>
				</ul>
			<?php endif; ?>
	</div>
	<?php
		// retrieves article nav
		if ( $wp_query->max_num_pages >= 2 ) {
			get_template_part( 'inc/index', 'nav' );
		} else {
			// avoids showing infinite scroll if there are no pages to load
		}
		?>
	</div>

<?php if ( get_theme_mod ('archive-post-sidebar' ) == 'on' ) {
		if ( is_front_page() ) {
			get_sidebar('home');
			} else {
				get_sidebar('archive');
			}
		}
	?>
</div>