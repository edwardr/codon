<?php
/**
 * codon functions and definitions
 *
 * @package codon
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 900; /* pixels */
}

if ( ! function_exists( 'codon_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function codon_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on codon, use a find and replace
	 * to change 'codon' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'codon', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'codon-wide-thumb', 366, 300, true );

	register_nav_menu( 'top-menu', __( 'Top Menu', 'codon' ) );
	if ( get_theme_mod ('footer-menu' ) == 'on' ) {
		register_nav_menu( 'bottom-menu', __( 'Footer Menu', 'codon' ) );
	}

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'codon_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_editor_style('/inc/custom-editor-style.css');

	function codon_custom_excerpt_length( $length ) {
		// checks for and sets the custom excerpt length
		if ( get_theme_mod ('excerpt-length' ) != null ) {
			return get_theme_mod ('excerpt-length' );
				} else {
			return null;
			}
	}
	add_filter( 'excerpt_length', 'codon_custom_excerpt_length', 999 );
}
endif; // codon_setup
add_action( 'after_setup_theme', 'codon_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function codon_widgets_init() {
if ( get_theme_mod ('header-widget') != 'off' && get_theme_mod ('header-style') == 'traditional' ) { 
register_sidebar(array(
	'name' => __( 'Header Widget', 'codon' ),
	'id' => 'header-widget',
	'description' => __( 'Widgets in this area will be shown on the right side of the header (Traditional header-style only).', 'codon' ),
	'before_widget' => '<div class="header-widget-wrapper">',
	'after_widget' => '</div>',
	'before_title' => '<div class="sidebar-title-block">',
	'after_title' => '</div>',
));
}
register_sidebar(array(
	'name' => __( 'Page Sidebar', 'codon' ),
	'id' => 'sidebar',
	'description' => __( 'Widgets in this area will be shown on pages.', 'codon' ),
	'before_widget' => '<div class="widget-wrapper">',
	'after_widget' => '</div>',
	'before_title' => '<div class="sidebar-title-block"><h4 class="sidebar">',
	'after_title' => '</h4></div>',
));

if ( get_theme_mod ('post-style') != 'full' ) {
register_sidebar(array(
	'name' => __( 'Post Sidebar', 'codon' ),
	'id' => 'post-sidebar',
	'description' => __( 'Widgets in this area will be shown on posts and archives.', 'codon' ),
	'before_widget' => '<div class="widget-wrapper">',
	'after_widget' => '</div>',
	'before_title' => '<div class="sidebar-title-block"><h4 class="sidebar">',
	'after_title' => '</h4></div>',
));
}

if ( get_theme_mod ('archive-post-sidebar') != 'off' ) {
register_sidebar(array(
	'name' => __( 'Archive Sidebar', 'codon' ),
	'id' => 'archive-sidebar',
	'description' => __( 'Widgets in this area will be shown on archive pages.', 'codon' ),
	'before_widget' => '<div class="widget-wrapper">',
	'after_widget' => '</div>',
	'before_title' => '<div class="sidebar-title-block"><h4 class="sidebar">',
	'after_title' => '</h4></div>',
));
}
register_sidebar(array(
	'name' => __( 'Home Sidebar', 'codon' ),
	'id' => 'home-sidebar',
	'description' => __( 'Widgets in this area will be shown on the homepage.', 'codon' ),
	'before_widget' => '<div class="widget-wrapper">',
	'after_widget' => '</div>',
	'before_title' => '<div class="sidebar-title-block"><h4 class="sidebar">',
	'after_title' => '</h4></div>',
));
register_sidebar(array(
	'name' => __( 'Below Posts' , 'codon' ),
	'id' => 'belowposts-sidebar',
	'description' => __( 'Widgets in this area will be shown beneath the blog post type. Use this for sharing, related articles and more.', 'codon' ),
	'before_title' => '<div class="sidebar-title-block"><h4 class="belowposts">',
	'after_title' => '</h4></div>',
	'before_widget' => '<div class="bottom-widget">',
	'after_widget' => '</div>',
));

if ( get_theme_mod ('footer-widgets' ) == 'on' ) {
	// makes sure footer widgets are turned on
register_sidebar(array(
	'name' => __( 'Footer Widget 1', 'codon' ),
	'id' => 'footer-widget-1',
	'description' => __( 'Widgets in this area will show up in the leftmost footer column.', 'codon' ),
	'before_widget' => '<div class="footer-widget">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="footer-title-block">',
	'after_title' => '</h4>',
));
register_sidebar(array(
	'name' => __( 'Footer Widget 2', 'codon' ),
	'id' => 'footer-widget-2',
	'description' => __( 'Widgets in this area will show up in the middle footer column.', 'codon' ),
	'before_widget' => '<div class="footer-widget">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="footer-title-block">',
	'after_title' => '</h4>',
));
register_sidebar(array(
	'name' => __( 'Footer Widget 3', 'codon' ),
	'id' => 'footer-widget-3',
	'description' => __( 'Widgets in this area will show up in the right footer column.', 'codon' ),
	'before_widget' => '<div class="footer-widget">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="footer-title-block">',
	'after_title' => '</h4>',
));

}
}
add_action( 'widgets_init', 'codon_widgets_init' );

// registers then enqueues scripts and styles
function codon_scripts() {
	$protocol = is_ssl() ? 'https' : 'http';
	// register styles
	wp_register_style( 'codon-google-fonts', "$protocol://fonts.googleapis.com/css?family=Open+Sans:700,400|Ubuntu:300,400,500,700" );
	wp_register_style( 'codon-foundation-style', get_template_directory_uri() . '/stylesheets/foundation.min.css', array(), '12102014', 'all' );
	wp_register_style( 'codon-font-awesome', get_template_directory_uri() . '/stylesheets/font-awesome.min.css', array(), '12102014', 'all' );
	// register scripts
	wp_register_script( 'codon-foundation', get_template_directory_uri() . '/js/foundation.min.js', array('jquery'), '1.0', true );
	wp_register_script( 'codon-modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '1.0', true );
	wp_register_script( 'codon-scripts', get_template_directory_uri() . '/js/codon-scripts.js', array('jquery'), '1.0', true );
	wp_register_script( 'codon-foundation-init', get_template_directory_uri() . '/js/foundation-init.js', array(), '1.0', true );
	wp_register_script( 'codon-fastclick', get_template_directory_uri() . '/js/vendor/fastclick.js', array(), '1.0', false );
	wp_register_script( 'codon-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0', true );
	wp_register_script( 'codon-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );
	wp_register_script ( 'codon-top-scroll', get_template_directory_uri() . '/js/top-return.js', array( 'jquery' ), '1.0', true);
	wp_register_script ('codon-infinite-scroll', get_template_directory_uri() . '/js/jquery.infinitescroll.js', array('jquery'), '2.0.2', true);
	wp_register_script( 'codon-scroll-disable', get_template_directory_uri() . '/js/jquery.scroll-disable.js', array('jquery'), '1.0', true );
	wp_register_script ('codon-infinite-scroll-init', get_template_directory_uri() . '/js/infinite-init.js', array('jquery'), '1.0', true);
	// enqueing styles
	wp_enqueue_style('codon-font-awesome');
	wp_enqueue_style( 'codon-google-fonts' );
	wp_enqueue_style( 'codon-foundation-style' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	// enqueing scripts
	wp_enqueue_script ('codon-scripts');
	wp_enqueue_script( 'codon-navigation');
	wp_enqueue_script( 'codon-modernizr');
	wp_enqueue_script('codon-fastclick');
	wp_enqueue_script('codon-foundation');
	wp_enqueue_script('codon-foundation-init');
	if ( get_theme_mod ('footer-top-return' ) == 'on' ) {
		wp_enqueue_script ('codon-top-scroll');
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
		wp_enqueue_script( 'comment-reply' ); 
	}
	$codon_options = '';
	if ( !is_singular() && get_theme_mod ('infinite-scroll') == 'on' ) {
		// enqueues script if infinite scroll is active
		wp_enqueue_script ('codon-infinite-scroll');
		wp_enqueue_script ('codon-infinite-scroll-init');
		}
	if ( get_theme_mod ('infinite-scroll') == 'off' ) {
		// loads fallback disabling script if infinite scroll is disabled
		wp_enqueue_script ('codon-scroll-disable');
		}
}
add_action( 'wp_enqueue_scripts', 'codon_scripts', 0 );

// modifies the password form for consistent button styling

function codon_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
	' . __( "To view this protected post, enter the password below.", "codon" ) . '
	<div class="row collapse">
	<div class="small-12 medium-8 medium-offset-2 columns">
	<div class="small-8 columns no-padding">
	<input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" />
	</div>
	<div class="small-4 columns no-padding">
	<input class="button small postfix hide-for-small" type="submit" name="Submit" value="' . esc_attr__( "Submit", "codon" ) . '" />
	</div>
	</div>
	</div>
	</form>';
	return $output;
}
add_filter( 'the_password_form', 'codon_password_form' );

// adds the post extras meta box
function codon_add_custom_box($post_types) {
	$types = array('post', 'page');
	if(in_array($post_types, $types)) {
		add_meta_box(
		'codon_sectionid',
			__( 'Extras', 'codon' ),
			'codon_inner_custom_box',
		$post_types, 'normal', 'high'
		);
		}
}

// prints the content box
function codon_inner_custom_box( $post ) {
	wp_nonce_field( plugin_basename( __FILE__ ), 'codon_noncename' );
	$value = get_post_meta( $post->ID, 'subtitle', true );
	echo '<label for="subtitle_field"><h4>';
	_e("Subtitle", 'codon' );
	echo '</h4></label>';
	echo '<input type="text" id="subtitle_field" name="subtitle_field" value="'.esc_attr($value).'" size="80" /><br>';

	// Videos
	$value = get_post_meta( $post->ID, 'codon_video', true );
	echo '<label for="videos"><h4>';
	_e('Featured Video Embed Code', 'codon' );
	echo '</h4></label>';
	echo '<textarea id="video_field" name="video_field" rows="10" cols="80">'.esc_attr($value).'</textarea><br>';
}

/* option check
function codon_post_extras_option_check($codon_meta_box) {
	$codon_options = codon_get_theme_options();
	$codon_meta_box = $codon_options['post_extras'];
	return $codon_meta_box;
}

if ( codon_post_extras_option_check(1) != 'off' ) {

*/

if ( get_theme_mod ('post-extras') == 'on' ) {
	add_action( 'add_meta_boxes', 'codon_add_custom_box', 1 );
}
// }

// saves data when post is saved
function codon_save_postdata( $post_id ) {
	if ( 'post' == $_POST ) {
	if ( ! current_user_can( 'edit_page', $post_id ) )
		return;
	} else {
	if ( ! current_user_can( 'edit_post', $post_id ) )
		return;
	}

	if ( ! isset( $_POST['codon_noncename'] ) || ! wp_verify_nonce( $_POST['codon_noncename'], plugin_basename( __FILE__ ) ) )
		return;
	$post_ID = $_POST['post_ID'];
	//sanitize user input
	$subtitlefield = sanitize_text_field( $_POST['subtitle_field'] );
	$videofield= ( $_POST['video_field'] );

	// updates the custom fields
	update_post_meta($post_ID, 'subtitle', $subtitlefield);
	update_post_meta($post_ID, 'codon_video', $videofield);
}

if ( get_theme_mod ('post-extras') == 'on' ) {
	add_action( 'save_post', 'codon_save_postdata' );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

function codon_default_mods () {
	if ( get_theme_mod ('header-style') == null ) {
	$header_style = 'traditional';
	} else {
	$header_style = get_theme_mod ('header-style');
	}
	if ( get_theme_mod ('header-widget') == null ) {
	$header_widget = 'on';
	} else {
	$header_widget = get_theme_mod ('header-widget');
	}
	if ( get_theme_mod ('codon-logo') == null ) {
	$codon_logo = '';
	} else {
	$codon_logo = get_theme_mod ('codon-logo');
	}
	if ( get_theme_mod ('header-description') == null ) {
	$header_description = 'on';
	} else {
	$header_description = get_theme_mod ('header-description');
	}
	if ( get_theme_mod ('infinite-scroll') == null ) {
	$infinite_scroll = 'on';
	} else {
	$infinite_scroll = get_theme_mod ('infinite-scroll');
	}
	if ( get_theme_mod ('excerpt-length') == null ) {
	$excerpt_length = '55';
	} else {
	$excerpt_length = get_theme_mod ('excerpt-length');
	}
	if ( get_theme_mod ('single-post-meta') == null ) {
	$single_post_meta = 'on';
	} else {
	$single_post_meta = get_theme_mod ('single-post-meta');
	}
	if ( get_theme_mod ('post-extras') == null ) {
	$post_extras = 'on';
	} else {
	$post_extras = get_theme_mod ('post-extras');
	}
	if ( get_theme_mod ('post-style') == null ) {
	$post_style = 'has-sidebar';
	} else {
	$post_style = get_theme_mod ('post-style');
	}
	if ( get_theme_mod ('post-breadcrumbs') == null ) {
	$post_breadcrumbs = 'on';
	} else {
	$post_breadcrumbs = get_theme_mod ('post-breadcrumbs');
	}
	if ( get_theme_mod ('page-breadcrumbs') == null ) {
	$page_breadcrumbs = 'on';
	} else {
	$page_breadcrumbs = get_theme_mod ('page-breadcrumbs');
	}
	if ( get_theme_mod ('post-navigation') == null ) {
	$post_navigationn = 'on';
	} else {
	$post_navigationn = get_theme_mod ('post-navigation');
	}
	if ( get_theme_mod ('authorbox') == null ) {
	$authorbox = 'on';
	} else {
	$authorbox = get_theme_mod ('authorbox');
	}
	if ( get_theme_mod ('post-display') == null ) {
	$post_display = 'blog-style';
	} else {
	$post_display = get_theme_mod ('post-display');
	}
	if ( get_theme_mod ('archive-post-sidebar') == null ) {
	$archive_post_sidebar = 'on';
	} else {
	$archive_post_sidebar = get_theme_mod ('archive-post-sidebar');
	}
	if ( get_theme_mod ('archive-post-meta') == null ) {
	$archive_post_meta = 'on';
	} else {
	$archive_post_meta = get_theme_mod ('archive-post-meta');
	}
	if ( get_theme_mod ('archive-post-content') == null ) {
	$archive_post_content = 'full';
	} else {
	$archive_post_content = get_theme_mod ('archive-post-content');
	}
	if ( get_theme_mod ('archive-post-thumnails') == null ) {
	$archive_post_thumbnails = 'off';
	} else {
	$archive_post_thumbnails = get_theme_mod ('archive-post-thumnails');
	}
	if ( get_theme_mod ('footer-credit') == null ) {
	$footer_credit = 'on';
	} else {
	$footer_credit = get_theme_mod ('footer-credit');
	}
	if ( get_theme_mod ('footer-widgets') == null ) {
	$footer_widgets = 'on';
	} else {
	$footer_widgets = get_theme_mod ('footer-widgets');
	}
	if ( get_theme_mod ('footer-menu') == null ) {
	$footer_menu = 'on';
	} else {
	$footer_menu = get_theme_mod ('footer-menu');
	}
	if ( get_theme_mod ('footer-top-return') == null ) {
	$footer_top_return = 'on';
	} else {
	$footer_top_return = get_theme_mod ('footer-top-return');
	}
	if ( get_theme_mod ('footer-socialblock') == null ) {
	$footer_socialblock = 'off';
	} else {
	$footer_socialblock = get_theme_mod ('footer-socialblock');
	}
	if ( get_theme_mod ('header-search') == null ) {
	$header_search = 'on';
	} else {
	$header_search = get_theme_mod ('header-search');
	}

	set_theme_mod( 'header-style', $header_style );
	set_theme_mod( 'header-widget', $header_widget );
	set_theme_mod( 'codon-logo', $codon_logo );
	set_theme_mod( 'header-search', $header_search );
	set_theme_mod( 'header-description', $header_description );
	set_theme_mod( 'infinite-scroll', $infinite_scroll );
	set_theme_mod( 'excerpt-length', $excerpt_length );
	set_theme_mod( 'single-post-meta', $single_post_meta );
	set_theme_mod( 'post-extras', $post_extras );
	set_theme_mod( 'post-style', $post_style );
	set_theme_mod( 'post-breadcrumbs', $post_breadcrumbs );
	set_theme_mod( 'page-breadcrumbs', $page_breadcrumbs );
	set_theme_mod( 'post-navigation', $post_navigationn );
	set_theme_mod( 'authorbox', $authorbox );
	set_theme_mod( 'post-display', $post_display );
	set_theme_mod( 'archive-post-sidebar', $archive_post_sidebar );
	set_theme_mod( 'archive-post-meta', $archive_post_meta );
	set_theme_mod( 'archive-post-content', $archive_post_content );
	set_theme_mod( 'archive-post-thumbnails', $archive_post_thumbnails );
	set_theme_mod( 'footer-credit', $footer_credit );
	set_theme_mod( 'footer-widgets', $footer_widgets );
	set_theme_mod( 'footer-menu', $footer_menu );
	set_theme_mod( 'footer-top-return', $footer_top_return );
	set_theme_mod( 'footer-socialblock', $footer_socialblock );
}
add_action('after_switch_theme', 'codon_default_mods');

function codon_activation_message() {
	function my_admin_notice() {
	?>
	<div class="updated">
		<p><?php _e( 'Please visit the <a href="customize.php">Customizer</a> to set up your site.', 'codon' ); ?></p>
	</div>
	<?php
	}
add_action( 'admin_notices', 'my_admin_notice' );
}
add_action('after_switch_theme', 'codon_activation_message');