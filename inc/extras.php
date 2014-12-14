<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package codon
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function codon_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'codon_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function codon_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'codon_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function codon_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'codon' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'codon_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function codon_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'codon_setup_author' );

// Comments
if ( ! function_exists( 'codon_comments' ) ) :
function codon_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
	case 'pingback' :
	case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php esc_attr_e( 'Pingback:', 'codon' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'codon' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
		break;
		default :
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<article id="comment-<?php comment_ID(); ?>" class="comment">
		<header class="comment-meta comment-author">
		<?php
			echo get_avatar( $comment, 77 );
			printf( '<cite class="fn">%1$s %2$s</cite>',
			get_comment_author_link(), ( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'codon' ) . '</span>' : '' );
			printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
			esc_url( get_comment_link( $comment->comment_ID ) ),
			get_comment_time( 'c' ), sprintf( __( '%1$s at %2$s', 'codon' ), get_comment_date(), get_comment_time() ) );
			?>
		</header>
		<?php if ( '0' == $comment->comment_approved ) : ?>
		<p class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.', 'codon' ); ?></p>
		<?php endif; ?>
		<section class="comment-content comment">
			<?php comment_text(); ?>
			<?php edit_comment_link( __( 'Edit', 'codon' ), '<p class="edit-link">', '</p>' ); ?>
		</section>
		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'codon' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
	</article>
<?php
	break;
	endswitch;
	}
	endif;

// adds a default menu link
function codon_link_to_menu_editor( $args ) {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	extract( $args );

	$link = $link_before . '<a href="' . admin_url( 'nav-menus.php' ) . '">' . $before . 'Add a menu' . $after . '</a>' . $link_after;

	if ( FALSE !== stripos( $items_wrap, '<ul' )
		or FALSE !== stripos( $items_wrap, '<ol' ) ) {
		$link = "<li>$link</li>";
	}

	$output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
	if ( ! empty ( $container ) ) {
		$output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
	}

	if ( $echo ) {
		echo $output;
	}

	return $output;
}