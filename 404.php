<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package codon
 */

get_header(); ?>

<div class="row content-wrap">
	<div class="small-12 columns main-content-area full-page">
		<div class="single-article" role="main">
			<div class="error-404 not-found">
				<?php codon_404_content(); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
