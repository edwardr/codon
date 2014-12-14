<?php
/**
* @package codon
*/
?>

<article <?php post_class( 'blog-layout-item' ); ?> id="post-<?php the_ID(); ?>">
	<h5 class="column-post-title">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
			<?php the_title(); ?>
		</a>
	</h5>

	<?php if ( get_theme_mod ('archive-post-meta') == 'on' ) { 
			codon_post_meta(); 
		} 
		?>

	<?php if ( has_post_thumbnail() ) { 
		// checks for the post thumbnail
		// then checks for a default image
		?>

	<a href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail('medium', array ('class' => 'alignleft codon-thumbnail') ); ?>
	</a>

	<?php }
	
		if ( get_theme_mod ('default-image') != '' && ! has_post_thumbnail()  ) { ?>
		<a href="<?php the_permalink(); ?>">
			<img src="<?php echo $codon_options['post_default_image']; ?>" alt="<?php the_title(); ?>"
				class="aligncenter codon-thumbnail" />
		</a>
	<?php } ?>

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