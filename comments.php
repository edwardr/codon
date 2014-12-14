<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package codon
 */

if ( post_password_required() )
	return;
	?>
<div id="comments" class="comments-area">
	<?php // You can start editing here -- including this comment! ?>
	<?php if ( have_comments() ) : ?>

	<h2 class="comments-title">
		<?php
		printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'codon' ),
		number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
		?>
	</h2>

	<ol class="commentlist">
		<?php wp_list_comments( array( 'callback' => 'codon_comments', 'style' => 'ol' ) ); ?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h6 class="assistive-text section-heading"><?php esc_attr_e( 'Comment navigation', 'codon' ); ?></h6>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'codon' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'codon' ) ); ?></div>
		</nav>
	<?php endif; // check for comment navigation ?>
	<?php
	/* If there are no comments and comments are closed, let's leave a note.
	* But we only want the note on posts and pages that had comments in the first place.
	*/
	if ( ! comments_open() && get_comments_number() ) : ?>
	<p class="nocomments"><?php esc_attr_e( 'Comments are closed.' , 'codon' ); ?></p>
	<?php endif; ?>
	<?php endif; // have_comments() ?>
	<?php comment_form(); ?>
</div>