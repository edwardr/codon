<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package codon
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// checks for breadcrumbs
		if ( get_theme_mod ('page-breadcrumbs') != 'off' ) {
				codon_page_breadcrumbs();
			}
			?>
	<header class="entry-header">
		<?php if ( !is_front_page() ) {
			the_title( '<h1 class="page-title">', '</h1>' ); 
				}
				?>
			<?php 
				// subtitle check
				$subtitle = get_post_meta ($post->ID, 'subtitle', true );
				if ( $subtitle != '' && get_theme_mod ('post-extras') != 'off' ) {
					echo '<h2 class="article-subtitle">' . $subtitle . '</h2>';
					}
				?>
	</header>

	<?php do_action ('codon_before_page_content' ); ?>

	<?php $codonvideometa = get_post_meta ($post->ID, 'codon_video', true);
		// makes sure video is active for page
		if ($codonvideometa != '' && get_theme_mod ('post-extras') != 'off' ) {
			?>
			
	<div class="flex-video">
		<?php echo get_post_meta($post->ID, 'codon_video', true); ?>
	</div>
		<?php } ?>

	<div class="entry-content-page">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'codon' ),
				'after'  => '</div>',
			) );
		?>
	</div>

	<footer class="entry-footer">
	<?php
		do_action ('codon_before_page_footer' );
		edit_post_link( __( 'Edit', 'codon' ), '<span class="edit-link">', '</span>' ); 
		?>
	</footer>
	
</article>
