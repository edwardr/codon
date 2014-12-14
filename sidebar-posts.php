<?php
/**
 * The sidebar containing the posts widget area.
 *
 * @package codon
 */
?>
<div class="small-12 medium-3 columns">
	<aside id="secondary" class="widget-area" role="complementary">
		<?php do_action( 'before_widget' ); ?>
		<?php if ( ! dynamic_sidebar( 'post-sidebar' ) ) : ?>
		<div class="widget-wrapper">
			<div class="sidebar-title-block">
				<h4 class="sidebar"><?php _e( 'Archives', 'codon' ); ?>
				</h4>
			</div>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</div>
		<?php endif; ?>
	</aside>
</div>

