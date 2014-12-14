<?php 
/**
 * index navigation file
 * loads infinite scroll and post nav
 * one is hidden depending on user setting
 * @package codon
 */
?>
<div class="row">
	<div id="infinite-scroll">
		<a class="secondary button" id="infinite-target"><?php _e('Load More', 'codon'); ?></a>
	</div>
	<div id="post-nav">
	<h6 class="screen-reader-text"><?php _e( 'Posts navigation', 'codon' ); ?></h6>
		<?php posts_nav_link(' ', '<i class="fa fa-arrow-left"></i>', '<i class="fa fa-arrow-right"></i>'); ?>
	</div>
</div>