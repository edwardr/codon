<?php
/**
 * @package codon
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'post' == get_post_type() && get_theme_mod ('post-breadcrumbs') != 'off' ) {
			codon_post_breadcrumbs();
			} 
			?>
			<?php the_title( '<h1 class="article-title">', '</h1>' ); ?>
			<?php // subtitle and option check
			$subtitle = get_post_meta ($post->ID, 'subtitle', true );
			if ( $subtitle != '' && get_theme_mod ('post-extras') != 'off' ) {
				echo '<h2 class="article-subtitle">' . $subtitle . '</h2>';
				}
				
			if ( get_theme_mod ('single-post-meta') != 'off' ) {
				codon_post_meta();
			}
			?>

	</header>

	<?php do_action ('codon_before_single_content'); ?>

	<?php $codonvideometa = get_post_meta ($post->ID, 'codon_video', true);
		if ($codonvideometa != '' && get_theme_mod ('post-extras') != 'off' ) {
			?>
	<div class="flex-video">
		<?php echo get_post_meta($post->ID, 'codon_video', true); ?>
	</div>
		<?php } ?>

	<div class="entry-content">
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
		do_action ('codon_before_single_footer' );
		codon_entry_footer(); ?>
	</footer>

</article>
