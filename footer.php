<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package codon
 */ 
?>

</div><!-- Ends Container -->

<div class="footer-widget-wrap">

<?php if ( get_theme_mod ('footer-widgets') == 'on' ) { ?>
	<div class="row">
		<div class="bottom-panel">
			<div class="small-12 columns">		
				<div class="small-12 medium-4 columns">
					<?php do_action ('before-widget');
						if ( !dynamic_sidebar ('footer-widget-1') ) :
							endif;
						?>
				</div>
				<div class="small-12 medium-4 columns">
					<?php do_action ('before-widget');
						if ( !dynamic_sidebar ('footer-widget-2') ) :
							endif;
						?>
				</div>
				<div class="small-12 medium-4 columns">
					<?php do_action ('before-widget');
						if ( !dynamic_sidebar ('footer-widget-3') ) :
							endif;
						?>
				</div>
			</div>
		</div>
	</div>

	<?php } ?>

	<div class="row">
		<div class="bottom-panel">
			<div class="small-12 columns">
				<footer id="main-footer" role="contentinfo">
					<?php if ( get_theme_mod ('footer-menu') == 'on' ) { ?>
					<nav id="footermenu" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'bottom-menu' ) ); ?>
					</nav>
					<?php } ?>

					<?php if( get_theme_mod ('footer-socialblock') != 'off' ) {
						// shows the social block if active
						?>
					<div class="row">
						<div id="social-block" class="small-12 columns">
							<?php codon_social_links(); ?>
						</div>
					</div>
					<?php } ?>

					<?php codon_footer_copyright(); ?>

					<?php if( get_theme_mod ('footer-credit') != 'off' ) {
						// shows the footer link if active
						?>
					<div class="row">
						<div id="credit" class="small-12 columns">
							<a href="https://www.edwardrjenkins.com/themes/codon">
								<small><?php esc_attr_e( 'built on the codon framework' , 'codon' ); ?></small>
							</a>
						</div>
					</div>
					<?php } ?>

					<?php if ( get_theme_mod ('footer-top-return') == 'on' ) {
						codon_top_return();
							}
							?>

				</footer>
			</div>

		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
<!--If you wish to make an apple pie from scratch, you must first invent the universe - Carl Sagan - the end! - ERJ -->
</html>