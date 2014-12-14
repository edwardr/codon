<?php
/**
 * Searchform template
 *
 * @package codon
 */
?>
<div class="row collapse">
	<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
		<div class="small-12 medium-8 columns no-padding">
			<label>
				<span class="screen-reader-text"><?php echo _e( 'Search for:', 'codon' ) ?></span>
				<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'codon' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'codon' ) ?>" />
			</label>
		</div>
		<div class="small-12 medium-4 columns no-padding">
			<input type="submit" class="search-submit button small postfix hide-for-small" value="<?php echo esc_attr_x( 'Search', 'submit button', 'codon' ) ?>" />
		</div>
	</form>
</div>