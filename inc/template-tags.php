<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package codon
 */

if ( ! function_exists( 'codon_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function codon_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h6 class="screen-reader-text"><?php _e( 'Post navigation', 'codon' ); ?></h6>
		<div class="nav-links">
			<?php
				$previous_post_link = '<i class="fa fa-arrow-left"></i>&nbsp;%title';
				$previous_post_link = apply_filters ('codon_previous_post_link', $previous_post_link );
				previous_post_link('%link', $previous_post_link);
				if ( get_next_post() != null ) {
				echo ' | ';
				$next_post_link = '%title&nbsp;<i class="fa fa-arrow-right"></i>';
				$next_post_link = apply_filters ('codon_next_post_link', $next_post_link );
				next_post_link('%link', $next_post_link );
				}
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( !function_exists ('codon_authorbox') ):

function codon_authorbox () {
	if ( is_author() ) {
	// prevents the author name from showing twice on the author archive page
		$author_name = null;
		} else {
		$author_name = '<h5>' . __( 'Author: ', 'codon' ) . get_the_author() . '</h5>';
		$author_name = apply_filters ('codon_authorbox_name', $author_name );
		}
	if ( get_avatar ( get_the_author_meta( 'ID' ), 250 ) != null ) {
		$author_avatar = '<div class="small-12 medium-3 columns">' . get_avatar( get_the_author_meta( 'ID' ), 250 ) . '</div>';
		$author_avatar = apply_filters ('codon_authorbox_avatar', $author_avatar );
		} else {
		$author_avatar = null;
		$author_avatar = apply_filters ('codon_authorbox_avatar', $author_avatar );
		}
	if ( get_the_author_meta ('googleplus') != null ) {
		$author_link_one = '<li><a href="' . get_the_author_meta ('googleplus') . '"><i class="fa fa-google-plus"></i></a></li>';
		$author_link_one = apply_filters ('author_link_one', $author_link_one );
		} else {
		$author_link_one = null;
		$author_link_one = apply_filters ('author_link_one', $author_link_one );
		}
	if ( get_the_author_meta ('linkedin') != null ) {
		$author_link_two = '<li><a href="' . get_the_author_meta ('linkedin') . '"><i class="fa fa-linkedin"></i></a></li>';
		$author_link_two = apply_filters ('author_link_two', $author_link_two );
		} else {
		$author_link_two = null;
		$author_link_two = apply_filters ('author_link_two', $author_link_two );
		}
	if ( get_the_author_meta ('facebook') != null ) {
		$author_link_three = '<li><a href="' . get_the_author_meta ('facebook') . '"><i class="fa fa-facebook"></i></a></li>';
		$author_link_three = apply_filters ('author_link_three', $author_link_three );
		} else {
		$author_link_three = null;
		$author_link_three = apply_filters ('author_link_three', $author_link_three );
		}
	if ( get_the_author_meta ('twitter') != null ) {
		$author_link_four = '<li><a href="https://twitter.com/' . get_the_author_meta ('twitter') . '"><i class="fa fa-twitter"></i></a></li>';
		$author_link_four = apply_filters ('author_link_four', $author_link_four );
		} else {
		$author_link_four = null;
		$author_link_four = apply_filters ('author_link_four', $author_link_four );
		}
	if ( get_the_author_meta ('user_url') != null ) {
		$author_link_five = '<li><a href="' . get_the_author_meta ('user_url') . '"><i class="fa fa-user"></i></a></li>';
		$author_link_five = apply_filters ('author_link_five', $author_link_five );
		} else {
		$author_link_five = null;
		$author_link_five = apply_filters ('author_link_five', $author_link_five );
		}
	$feedlink = get_the_author_meta ( get_author_feed_link( get_the_author_meta ('ID') ) );
	if ( $feedlink != null ) {
		$author_link_six = '<li><a href="' . $feedlink . '"><i class="fa fa-rss"></i></a></li>';
		$author_link_six = apply_filters ('author_link_six', $author_link_six );
		} else {
		$author_link_six = null;
		$author_link_six = apply_filters ('author_link_six', $author_link_six );
		}

	if ( get_the_author_meta('description') != null ) {
		$author_bio = '<p>' . get_the_author_meta('description') . '</p>';
		} else {
		$author_bio = null;
		}

	echo '<div id="author-box" class="row">' . $author_name . $author_avatar;
	echo '<div class="small-12 medium-9 columns">' . $author_bio . '<ul class="social-links">' . $author_link_one . $author_link_two . $author_link_three . $author_link_four . $author_link_five . $author_link_six . '</ul></div></div>';

}
endif;

if ( ! function_exists( 'codon_post_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function codon_post_meta() {
	// builds css class
	if ( is_single() ) {
		$meta_class = 'single-meta';
	} else {
		$meta_class = 'archive-meta';
	}

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$date_year  = get_the_date ('Y');
	$date_month = get_the_date ('m');
	$date_day 	= get_the_date ('d');

	$posted_on = sprintf(
		_x( '%s', 'post date', 'codon' ),
		'<span class="post-info ' . $meta_class . '-date"><i class="fa fa-calendar fa-lg"></i> <a href="' . get_day_link ( $date_year, $date_month, $date_day ) . '" rel="bookmark">' . $time_string . '</a></i></span>'
	);

	$posted_on = apply_filters ('codon_posted_on' , $posted_on );

	$byline = sprintf(
		_x( '%s', 'post author', 'codon' ),
		'<span class="post-info ' . $meta_class . '-author"><i class="fa fa-user fa-lg"></i> <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	$byline = apply_filters ('codon_byline', $byline );

	$cat_links = get_the_category_list(', ');

	$post_categories = '<span class="post-info ' . $meta_class . '-cat"><i class="fa fa-archive fa-lg"></i>' . $cat_links . '</span>';

	$post_categories = apply_filters ('codon_category', $post_categories );

	$post_format = get_post_format();

	if ( $post_format == 'image' || 'gallery' ) {
		$format_icon = 'fa-picture-o';
	}

	if ( $post_format == 'aside' ) {
		$format_icon = 'fa-asterisk';
	}

	if ( $post_format == 'link' ) {
		$format_icon = 'fa-link';
	}

	if ( $post_format == 'video' ) {
		$format_icon = 'fa-video-camera';
	}

	if ( $post_format == 'quote' ) {
		$format_icon = 'fa-quote-left';
	}

	if ( $post_format == 'status' ) {
		$format_icon = 'fa-tasks';
	}

	if ( $post_format == 'audio' ) {
		$format_icon = 'fa-headphones';
	}

	if ( $post_format == 'chat' ) {
		$format_icon = 'fa-comments-o';
	}


	if ( $post_format != null ) {
		$post_format_link = '<span class="post-info ' . $meta_class . '-date"><i class="fa ' . $format_icon . ' fa-lg"></i><a href="' . get_post_format_link($post_format) . '"> ' . get_post_format_string( $post_format ) . '</a></span>';
		$post_format_link = apply_filters ('codon_post_format', $post_format_link );
	} else {
		$post_format_link = null;
	}
	echo '<div class="' . $meta_class . '">' . $posted_on . $byline . $post_format_link . $post_categories . '</div>';
}
endif;

if ( ! function_exists ( 'codon_featured_image' ) ):

function codon_featured_image() {
	// checks for the post thumbnail
	// then checks for a default image
	if ( has_post_thumbnail() && get_theme_mod ('archive-post-thumbnails' ) != 'off' ) {
		if ( get_theme_mod('archive-post-thumbnails' ) == 'thumbnail' ) {
			$thumbnail = 'thumbnail';
		} elseif ( get_theme_mod('archive-post-thumbnails' ) == 'medium' )
			$thumbnail = 'medium';
		elseif ( get_theme_mod('archive-post-thumbnails' ) == 'full' )
			$thumbnail = 'codon-wide-thumb';
		if ( get_theme_mod('archive-post-thumbnails-alignment' ) == 'left' ) {
			$alignment = 'alignleft';
		} elseif ( get_theme_mod('archive-post-thumbnails-alignment' ) == 'center' )
			$alignment = 'aligncenter';
		elseif ( get_theme_mod('archive-post-thumbnails-alignment' ) == 'right' )
			$alignment = 'alignright';

		echo '<a href="' . get_the_permalink() . '">' . the_post_thumbnail($thumbnail, array ('class' => $alignment . ' codon-thumbnail') ) . '</a>';
	}
	if ( get_theme_mod ('default-image') != '' && ! has_post_thumbnail() && get_theme_mod ('archive-post-thumbnails' ) != 'off' ) {
		if ( get_theme_mod('archive-post-thumbnails' ) == 'thumbnail' ) {
			$thumbnail = 'thumbnail';
		} elseif ( get_theme_mod('archive-post-thumbnails' ) == 'medium' )
			$thumbnail = 'medium';
		elseif ( get_theme_mod('archive-post-thumbnails' ) == 'full' )
			$thumbnail = 'codon-wide-thumb';
		if ( get_theme_mod('archive-post-thumbnails-alignment' ) == 'left' ) {
			$alignment = 'alignleft';
		} elseif ( get_theme_mod('archive-post-thumbnails-alignment' ) == 'center' )
			$alignment = 'aligncenter';
		elseif ( get_theme_mod('archive-post-thumbnails-alignment' ) == 'right' )
			$alignment = 'alignright';
		if ( $thumbnail == 'thumbnail' ) {
			$image_size = get_option( 'thumbnail_size_w' );
		}
		if ( $thumbnail == 'medium' ) {
			$image_size = get_option( 'medium_size_w' );
		}
		if ( $thumbnail == 'codon-wide-thumb' ) {
			$image_size = '366';
			$image_size = apply_filters ('codon_wide_thumb_size', $image_size );
		}
		echo '<a href="' . get_the_permalink() . '"><img width="' . $image_size . '" src="'. get_theme_mod ('default-image') . '" alt="' . get_the_title() . '" class="' .  $alignment . ' codon-thumbnail" /></a>';
	}
}
endif;

if ( ! function_exists( 'codon_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 */
function codon_the_attached_imaged() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'codon_attachment_size', array( 1200, 1200 ) );
	$next_attachment_url = wp_get_attachment_url();
	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachments = array_values( get_children( array(
		'post_parent'    => $post->post_parent,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) ) );
	// If there is more than 1 attachment in a gallery...
	if ( count( $attachments ) > 1 ) {
		foreach ( $attachments as $k => $attachment ) {
			if ( $attachment->ID == $post->ID )
				break;
		}
		$k++;
		// get the URL of the next image attachment...
		if ( isset( $attachments[ $k ] ) )
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( $attachments[0]->ID );
	}
	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists ( 'codon_category_heading' ) ):

function codon_category_heading() {
	$title = '<h1 class="page-title">' . single_cat_title ('<i class="fa fa-archive"></i> ');
	$title = apply_filters ('codon_category_header', $title );
	$desc  = category_description();
	if ( $desc != '' ) {
		$cat_desc = '<p>' . $desc . '</p>';
		} else {
		$cat_desc = null;
		}
	echo $title . $cat_desc;
}
endif;

if ( ! function_exists ( 'codon_footer_copyright' ) ):

function codon_footer_copyright() {
	$output = '<small id="site-info">&copy;' . date('Y') . ' - ' . get_bloginfo('name') . '</small><br>';
	$output = apply_filters ('codon_footer_text', $output );
	echo $output;
}
endif;

if ( ! function_exists ( 'codon_tag_heading' ) ):

function codon_tag_heading() {
	$title = '<h1 class="page-title">' . single_cat_title ('<i class="fa fa-tags"></i> ');
	$title = apply_filters ('codon_tag_header', $title );
	$desc  = term_description();
	if ( $desc != '' ) {
		$tag_desc = '<p>' . $desc . '</p>';
		} else {
		$tag_desc = null;
		}
	echo $title . $tag_desc;
}
endif;

if ( ! function_exists ( 'codon_archive_heading' ) ):

function codon_archive_heading() {
	if ( is_day() ) {
		echo '<i class="fa fa-calendar"></i> ';
		_e( 'Daily Archives: ', 'codon' );
		echo get_the_time('l, F j, Y');
	}
	elseif ( is_month() ) {
		echo '<i class="fa fa-calendar"></i> ';
		_e( 'Monthly Archives: ', 'codon' );
		echo get_the_time('F Y');
	}
		elseif ( is_year() ) {
			echo '<i class="fa fa-calendar"></i> ';
			_e( 'Yearly Archives: ', 'codon' );
			echo get_the_time('Y');
		}
			// post formats
				elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
					_e( '<i class="fa fa-asterisk"></i> Asides', 'codon' );
					}
				elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
					_e( '<i class="fa fa-picture-o"></i> Galleries', 'codon' );
					}
				elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
					_e( '<i class="fa fa-picture-o"></i> Images', 'codon' );
					}
				elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
					_e( '<i class="fa fa-video-camera"></i> Videos', 'codon' );
					}
				elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
					_e( '<i class="fa fa-quote-left"></i> Quotes', 'codon' );
					}
				elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
					_e( '<i class="fa fa-link"></i> Links', 'codon' );
					}
				elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
					_e( '<i class="fa fa-tasks"></i> Statuses', 'codon' );
					}	
				elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
					_e( '<i class="fa fa-headphones"></i> Audios', 'codon' );
					}
				elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
					_e( '<i class="fa fa-comments-o"></i> Chats', 'codon' );
					}
			else {
			_e( '<i class="fa fa-folder-open"></i> Archives', 'codon' );
			}
}
endif;

if ( ! function_exists ( 'codon_post_breadcrumbs' ) ) :

function codon_post_breadcrumbs() {
	if ( 'post' == get_post_type() ) {
		$home_url = home_url( '/' );
		$home_label = __('Home', 'codon' );
		$post_category = get_the_category_list(' | ');
		$post_title = get_the_title();

		echo '<div class="nav codon-breadcrumbs">
		<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
		<a href=" ' . $home_url . '" itemprop="url">' . $home_label . '</a> &#8250; ' . $post_category . ' &#8250; <span itemprop="title">' . $post_title . '</span></div></div>';
	}
}
endif;

if ( ! function_exists ( 'codon_page_breadcrumbs' ) ) :

function codon_page_breadcrumbs() {
	if ( 'page' == get_post_type() ) {
		global $post;
		$home_url = home_url( '/' );
		$home_label = __('Home', 'codon' );
		$post_category = get_the_category_list(' | ');
		$post_title = get_the_title();
		if ( $post->post_parent == true ) {
		$parent_title = get_the_title ($post->post_parent);
		$parent_link = get_the_permalink ($post->post_parent);
		$parent_output = '<a href="' . $parent_link . '">' . $parent_title . '</a> &#8250; ';
		} else {
			$parent_output = null;
		}

		echo '<div class="nav codon-breadcrumbs">
		<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
		<a href=" ' . $home_url . '" itemprop="url">' . $home_label . '</a> &#8250; ' . $parent_output . '<span itemprop="title">' . $post_title . '</span></div></div>';
	}
}
endif;

if ( ! function_exists( 'codon_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function codon_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', ', ' );
		if ( $tags_list && get_theme_mod ('single-post-meta') == 'on' ) {
			printf( '<span class="post-info"><i class="fa fa-tag fa-lg"></i>&nbsp;' . __( '%1$s', 'codon' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'codon' ), __( '1 Comment', 'codon' ), __( '% Comments', 'codon' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'codon' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'codon_top_return' ) ):
// loads the top return link
// also see codon-scripts.js
function codon_top_return() {
	$top_return = '<a href="#" id="top-return"><i class="fa fa-arrow-up fa-lg"></i></a>';
	$top_return = apply_filters ('codon_return_to_top', $top_return );

	echo  $top_return;
}
endif;

if  (!function_exists ( 'codon_social_links' ) ):
	// builds list items
function codon_social_links() {
	if ( get_theme_mod ('footer-facebook' ) != '' ) {
		$facebook = '<li><a href="' . get_theme_mod ('footer-facebook' ) . '"><i class="fa fa-facebook fa-lg"></i></a></li>';
		$facebook = apply_filters ('codon_social_facebook', $facebook );
	} else {
		$facebook = null;
	}

	if ( get_theme_mod ('footer-gplus' ) != '' ) {
		$gplus = '<li><a href="' . get_theme_mod ('footer-gplus' ) . '"><i class="fa fa-google-plus fa-lg"></i></a></li>';
		$gplus = apply_filters ('codon_social_gplus', $gplus );
	} else {
		$gplus = null;
	}

	if ( get_theme_mod ('footer-twitter' ) != '' ) {
		$twitter = '<li><a href="' . get_theme_mod ('footer-twitter' ) . '"><i class="fa fa-twitter fa-lg"></i></a></li>';
		$twitter = apply_filters ('codon_social_twitter', $twitter );
	} else {
		$twitter = null;
	}

	if ( get_theme_mod ('footer-pinterest' ) != '' ) {
		$pinterest = '<li><a href="' . get_theme_mod ('footer-pinterest' ) . '"><i class="fa fa-pinterest fa-lg"></i></a></li>';
		$pinterest = apply_filters ('codon_social_pinterest', $pinterest );
	} else {
		$pinterest = null;
	}

	if ( get_theme_mod ('footer-youtube' ) != '' ) {
		$youtube = '<li><a href="' . get_theme_mod ('footer-youtube' ) . '"><i class="fa fa-youtube fa-lg"></i></a></li>';
		$youtube = apply_filters ('codon_social_youtube', $youtube );
	} else {
		$youtube = null;
	}

	if ( get_theme_mod ('footer-instagram' ) != '' ) {
		$instagram = '<li><a href="' . get_theme_mod ('footer-instagram' ) . '"><i class="fa fa-instagram fa-lg"></i></a></li>';
		$instagram = apply_filters ('codon_social_instagram', $instagram );
	} else {
		$instagram = null;
	}

	if ( get_theme_mod ('footer-yelp' ) != '' ) {
		$yelp = '<li><a href="' . get_theme_mod ('footer-yelp' ) . '"><i class="fa fa-yelp fa-lg"></i></a></li>';
		$yelp = apply_filters ('codon_social_yelp', $yelp );
	} else {
		$yelp = null;
	}

	if ( get_theme_mod ('footer-tumblr' ) != '' ) {
		$tumblr = '<li><a href="' . get_theme_mod ('footer-tumblr' ) . '"><i class="fa fa-tumblr fa-lg"></i></a></li>';
		$tumblr = apply_filters ('codon_social_tumblr', $tumblr );
	} else {
		$tumblr = null;
	}

	if ( get_theme_mod ('footer-reddit' ) != '' ) {
		$reddit = '<li><a href="' . get_theme_mod ('footer-reddit' ) . '"><i class="fa fa-reddit fa-lg"></i></a></li>';
		$reddit = apply_filters ('codon_social_reddit', $reddit );
	} else {
		$reddit = null;
	}

	if ( get_theme_mod ('footer-github' ) != '' ) {
		$github = '<li><a href="' . get_theme_mod ('footer-github' ) . '"><i class="fa fa-github fa-lg"></i></a></li>';
		$github = apply_filters ('codon_social_github', $github );
	} else {
		$github = null;
	}

	if ( get_theme_mod ('footer-skype' ) != '' ) {
		$skype = '<li><a href="' . get_theme_mod ('footer-skype' ) . '"><i class="fa fa-skype fa-lg"></i></a></li>';
		$skype = apply_filters ('codon_social_skype', $skype );
	} else {
		$skype = null;
	}

	if ( get_theme_mod ('footer-rss' ) != '' ) {
		$rss = '<li><a href="' . get_theme_mod ('footer-rss' ) . '"><i class="fa fa-rss fa-lg"></i></a></li>';
		$rss = apply_filters ('codon_social_rss', $rss );
	} else {
		$rss = null;
	}

	echo '<ul class="social-links">' . $facebook . $twitter . $gplus . $pinterest . $youtube . $instagram . $tumblr . $reddit . $github . $skype . $rss . '</ul>';
}
endif;

if ( !function_exists ( 'codon_404_content' ) ):

function codon_404_content() {
	$title	 = '<h1>' . __('404 - Page Not Found', 'codon' ) . '</h1>';
	$message = '<h5>' . __('Whoops. The page you were looking for has gone extinct. Maybe you can find what you were looking for below.', 'codon' ) . '</h5>';
	$search  = '<div class="small-12 medium-6 medium-centered columns">' . get_search_form (false) . '</div>';

	// retrieves a list of pages
	$args = array (
		'title_li' => '',
		'echo' => 0,
		'depth' => 1,
		);
	$pages =  wp_list_pages( $args );
	$page_list = '<div id="page-list-icon" class="text-center"><i class="fa fa-sitemap fa-lg text-center"></i></div><ul class="small-block-grid-2 medium-block-grid-5">' . $pages . '</ul>';

	$error_content = $title . '<article>' . $message . $search . $page_list . '</article>';
	$error_content = apply_filters ('codon_error_content', $error_content );

	echo $error_content;
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function codon_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'codon_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'codon_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so codon_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so codon_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in codon_categorized_blog.
 */
function codon_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'codon_categories' );
}
add_action( 'edit_category', 'codon_category_transient_flusher' );
add_action( 'save_post',     'codon_category_transient_flusher' );
