<?php 
/**
* displays content for archive pages
* used on all archives
* @package codon
*/
?>

<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<h4 class="column-post-title">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
			<?php the_title(); ?>
		</a>
	</h4>

	<?php if ( get_theme_mod ('archive-post-meta') == 'on' ) {
			codon_post_meta(); 
		}
		?>

	<?php codon_featured_image(); ?>

	<?php
	if ( get_theme_mod ('excerpt-length') != '0' && get_theme_mod ('archive-post-content') == 'excerpt' ) { ?>
		<div class="codon-excerpt">
			<?php the_excerpt(); ?>
		</div>
		<?php } ?>

	<?php if ( get_theme_mod ('archive-post-content' ) == 'full' ) { ?>
	<div class="codon-excerpt">
		<?php the_content(); ?>
	</div>
	<?php } ?>

</article>
