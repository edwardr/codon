<?php
/**
 * codon theme customizer
 *
 * @package codon
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function codon_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

// header options
$wp_customize->add_section( 'header' , array(
	'title' => __( 'Header Options', 'codon' ),
	'priority' => 10,
	'description' => __( 'Select your header options.', 'codon' )
) );

// display options
$wp_customize->add_section( 'display' , array(
	'title' => __( 'Display Options', 'codon' ),
	'priority' => 13,
	'description' => __( 'Select your display options.', 'codon' )
) );

// single options
$wp_customize->add_section( 'single' , array(
	'title' => __( 'Single Content', 'codon' ),
	'priority' => 12,
	'description' => __( 'Select options for single-content templates.', 'codon' )
) );

// archive options
$wp_customize->add_section( 'archive' , array(
	'title' => __( 'Archive Content', 'codon' ),
	'priority' => 11,
	'description' => __( 'Select options for archive-content templates.', 'codon' )
) );

// archive options
$wp_customize->add_section( 'footer' , array(
	'title' => __( 'Footer Options', 'codon' ),
	'priority' => 14,
	'description' => __( 'Select options for the footer.', 'codon' )
) );

// add header settings
$wp_customize->add_setting( 'header-style' , array( 'default' => 'traditional', 'sanitize_callback' => 'codon_mod_validation' ));
$wp_customize->add_setting( 'header-search' , array( 'default' => 'on', 'sanitize_callback' => 'codon_mod_validation'  ));
$wp_customize->add_setting( 'header-widget' , array( 'default' => 'on', 'sanitize_callback' => 'codon_mod_validation'  ));
$wp_customize->add_setting( 'codon-logo' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
$wp_customize->add_setting( 'header-description' , array( 'default' => 'on', 'sanitize_callback' => 'codon_mod_validation' ));
$wp_customize->add_setting( 'codon-topbar-logo' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));

// adds header controls
$wp_customize->add_control(
	'header_style', 
	array(
		'label'    => __( 'Header Style', 'codon' ),
		'description' => __( 'After saving the header style, refresh the customizer page to see the header-specific logo option.', 'codon' ),
		'section'  => 'header',
		'settings' => 'header-style',
		'type'     => 'radio',
		'choices'  => array(
			'topbar'  => 'Topbar (beta)',
			'traditional' => 'Traditional',
		),
	)
);

$wp_customize->add_control(
	'header_description', 
	array(
		'label'    => __( 'Site Description', 'codon' ),
		'description' => __( 'Enable or disable the header site description.', 'codon' ),
		'section'  => 'header',
		'settings' => 'header-description',
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);

// only shows the header logo and widget area options with the traditional style header
if ( get_theme_mod ('header-style' ) == 'traditional' ) {

$wp_customize->add_control(
	new WP_Customize_Image_Control(
	$wp_customize,
	'codon_logo',
		array(
		'label'      => __( 'Header Logo', 'codon' ),
		'section'    => 'header',
		'settings'   => 'codon-logo',
		)
	)
	);
$wp_customize->add_control(
	'header_search', 
	array(
		'label'    => __( 'Header Search Bar', 'codon' ),
		'section'  => 'header',
		'settings' => 'header-search',
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);
$wp_customize->add_control(
	'header_widget', 
	array(
		'label'    => __( 'Header Widget Area', 'codon' ),
		'section'  => 'header',
		'settings' => 'header-widget',
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);
}

// only shows the topbar logo with the topbar header
if ( get_theme_mod ('header-style' ) == 'topbar' ) {
$wp_customize->add_control(
	   new WP_Customize_Image_Control(
		   $wp_customize,
		   'codon_topbar_logo',
		   array(
			   'label'      => __( 'Topbar Logo', 'codon' ),
			   'description' => __( '<em>Max height: 45px</em>', 'codon' ),
			   'section'    => 'header',
			   'settings'   => 'codon-topbar-logo',
		   )
	   )
   );
}

// add display settings
$wp_customize->add_setting( 'infinite-scroll' , array( 'default' => 'on', 'sanitize_callback' => 'codon_mod_validation' ));
$wp_customize->add_setting( 'default-image' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
$wp_customize->add_setting( 'excerpt-length' , array( 'default' => '55', 'sanitize_callback' => 'sanitize_text_field'  ));

// adds display controls
$wp_customize->add_control(
	'infinite_scroll', 
	array(
		'label'    => __( 'Infinite Scroll', 'codon' ),
		'section'  => 'display',
		'settings' => 'infinite-scroll',
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);

$wp_customize->add_control(
	   new WP_Customize_Image_Control(
		   $wp_customize,
		   'default_image',
		   array(
			   'label'      => __( 'Post Default Image', 'codon' ),
			   'description' => __( 'Used if a featured image is not present', 'codon' ),
			   'section'    => 'display',
			   'settings'   => 'default-image',
		   )
	   )
   );

$wp_customize->add_control(
	'excerpt_length', 
	array(
	'type'        => 'number',
	'section'     => 'display',
	'settings'	  => 'excerpt-length',
	'label'       => 'Excerpt Length',
	'description' => 'Set the post excerpt length',
	'input_attrs' => array(
		'min'   => 0,
		'max'   => 100,
	),
) );

// add single settings
$wp_customize->add_setting( 'single-post-meta' , array( 'default' => 'on', 'sanitize_callback' => 'codon_mod_validation'  ));
$wp_customize->add_setting( 'post-extras' , array( 'default' => 'on', 'sanitize_callback' => 'codon_mod_validation' ));
$wp_customize->add_setting( 'post-style' , array( 'default' => 'has-sidebar', 'sanitize_callback' => 'codon_mod_validation'  ));
$wp_customize->add_setting( 'post-breadcrumbs' , array( 'default' => 'on', 'sanitize_callback' => 'codon_mod_validation'  ));
$wp_customize->add_setting( 'page-breadcrumbs' , array( 'default' => 'on', 'sanitize_callback' => 'codon_mod_validation' ));
$wp_customize->add_setting( 'post-navigation' , array( 'default' => 'on', 'sanitize_callback' => 'codon_mod_validation'  ));
$wp_customize->add_setting( 'authorbox' , array( 'default' => 'on', 'sanitize_callback' => 'codon_mod_validation'  ));

// adds single controls
$wp_customize->add_control(
	'single_post_meta', 
	array(
		'label'    => __( 'Post Meta', 'codon' ),
		'section'  => 'single',
		'settings' => 'single-post-meta',
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);

$wp_customize->add_control(
	'post_navigation', 
	array(
		'label'    => __( 'Post Navigation', 'codon' ),
		'section'  => 'single',
		'settings' => 'post-navigation',
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);

$wp_customize->add_control(
	'post_navigation', 
	array(
		'label'    => __( 'Authorbox', 'codon' ),
		'section'  => 'single',
		'settings' => 'authorbox',
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);

$wp_customize->add_control(
	'post_breadcrumbs', 
	array(
		'label'    => __( 'Post Breadcrumbs', 'codon' ),
		'section'  => 'single',
		'settings' => 'post-breadcrumbs',
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);

$wp_customize->add_control(
	'page_breadcrumbs', 
	array(
		'label'    => __( 'Page Breadcrumbs', 'codon' ),
		'section'  => 'single',
		'settings' => 'page-breadcrumbs',
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);

$wp_customize->add_control(
	'post_extras', 
	array(
		'label'    => __( 'Post Extras', 'codon' ),
		'description' => __( 'Enable or disable the post extras box (subtitle and featured video).', 'codon' ),
		'section'  => 'single',
		'settings' => 'post-extras',
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);

$wp_customize->add_control(
	'post_style', 
	array(
		'label'    => __( 'Post Style', 'codon' ),
		'description' => __( 'Choose whether or not to display the sidebar on single posts.', 'codon' ),
		'section'  => 'single',
		'settings' => 'post-style',
		'type'     => 'radio',
		'choices'  => array(
			'has-sidebar'  => 'With Sidebar',
			'full-width' => 'Full Width',
		),
	)
);

// add archive settings
$wp_customize->add_setting( 'post-display' , array( 'default' => 'three-columns', 'sanitize_callback' => 'codon_mod_validation' ));
$wp_customize->add_setting( 'archive-post-sidebar' , array( 'default' => 'on', 'sanitize_callback' => 'codon_mod_validation' ));
$wp_customize->add_setting( 'archive-post-meta' , array( 'default' => 'on', 'sanitize_callback' => 'codon_mod_validation' ));
$wp_customize->add_setting( 'archive-post-content' , array( 'default' => 'excerpt', 'sanitize_callback' => 'codon_mod_validation' ));
$wp_customize->add_setting( 'archive-post-thumbnails' , array( 'default' => 'thumbnail', 'sanitize_callback' => 'codon_mod_validation' ));
$wp_customize->add_setting( 'archive-post-thumbnails-alignment' , array( 'default' => 'left', 'sanitize_callback' => 'codon_mod_validation' ));

// adds archive controls
$wp_customize->add_control(
	'post_display', 
	array(
		'label'    => __( 'Post Display', 'codon' ),
		'description' => __( 'If using the three-column layout, make sure your post per page value in Settings->Reading is divisible by 3 for best results.', 'codon' ),
		'section'  => 'archive',
		'settings' => 'post-display',
		'type'     => 'radio',
		'choices'  => array(
			'blog-style'  => 'Blog Style',
			'two-columns' => 'Two Post Columns',
			'three-columns' => 'Three Post Columns',
		),
	)
);

$wp_customize->add_control(
	'archive_post_sidebar', 
	array(
		'label'    => __( 'Archive Sidebar', 'codon' ),
		'description' => __( 'Turn the sidebar on or off.', 'codon' ),
		'section'  => 'archive',
		'settings' => 'archive-post-sidebar',
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);

$wp_customize->add_control(
	'post_thumbnails', 
	array(
		'label'    => __( 'Post Thumbnails', 'codon' ),
		'description' => __( 'Choose your archive thumbnail size.', 'codon' ),
		'section'  => 'archive',
		'settings' => 'archive-post-thumbnails',
		'type'     => 'radio',
		'choices'  => array(
			'thumbnail'  => 'Thumbnail',
			'medium' 	 => 'Medium',
			'full'		 => 'Full Column',
			'off'  		 => 'Off',
		),
	)
);

$wp_customize->add_control(
	'post_thumbnails_alignment', 
	array(
		'label'    => __( 'Post Thumbnail Alignment', 'codon' ),
		'description' => __( 'Choose your archive thumbnail alignment.', 'codon' ),
		'section'  => 'archive',
		'settings' => 'archive-post-thumbnails-alignment',
		'type'     => 'radio',
		'choices'  => array(
			'left'  => 'Left',
			'center' => 'Center',
			'right' => 'Right',
		),
	)
);

$wp_customize->add_control(
	'archive_post_meta', 
	array(
		'label'    => __( 'Post Meta', 'codon' ),
		'section'  => 'archive',
		'settings' => 'archive-post-meta',
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);

$wp_customize->add_control(
	'archive_post_content', 
	array(
		'label'    => __( 'Post Excerpts', 'codon' ),
		'description' => __('Showing the full content works best with the blog-style archive layout.', 'codon' ),
		'section'  => 'archive',
		'settings' => 'archive-post-content',
		'type'     => 'radio',
		'choices'  => array(
			'excerpt'  => 'Excerpt',
			'full' => 'Full Content',
		),
	)
);

// add footer settings
$wp_customize->add_setting( 'footer-credit' , array( 'default' => 'on', 'sanitize_callback' => 'codon_mod_validation' ));
$wp_customize->add_setting( 'footer-widgets' , array( 'default' => 'on', 'sanitize_callback' => 'codon_mod_validation' ));
$wp_customize->add_setting( 'footer-menu' , array( 'default' => 'on', 'sanitize_callback' => 'codon_mod_validation' ));
$wp_customize->add_setting( 'footer-top-return' , array( 'default' => 'on', 'sanitize_callback' => 'codon_mod_validation' ));
$wp_customize->add_setting( 'footer-socialblock' , array( 'default' => 'off', 'sanitize_callback' => 'codon_mod_validation' ));
$wp_customize->add_setting( 'footer-facebook' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
$wp_customize->add_setting( 'footer-gplus' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
$wp_customize->add_setting( 'footer-twitter' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
$wp_customize->add_setting( 'footer-pinterest' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
$wp_customize->add_setting( 'footer-youtube' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
$wp_customize->add_setting( 'footer-instagram' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
$wp_customize->add_setting( 'footer-yelp' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
$wp_customize->add_setting( 'footer-tumblr' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
$wp_customize->add_setting( 'footer-reddit' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
$wp_customize->add_setting( 'footer-github' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
$wp_customize->add_setting( 'footer-skype' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
$wp_customize->add_setting( 'footer-rss' , array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));

// adds header controls
$wp_customize->add_control(
	'footer_widgets', 
	array(
		'label'    => __( 'Footer Widgets', 'codon' ),
		'description' => __( 'Enable or disable the footer widget areas.', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-widgets',
		'priority' => 1,
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);

$wp_customize->add_control(
	'footer_menu', 
	array(
		'label'    => __( 'Footer Menu', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-menu',
		'priority' => 3,
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);

$wp_customize->add_control(
	'footer_credit', 
	array(
		'label'    => __( 'Footer Credit Link', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-credit',
		'priority' => 2,
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);

$wp_customize->add_control(
	'footer_top_return', 
	array(
		'label'    => __( 'Return to Top Link', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-top-return',
		'priority' => 4,
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);

$wp_customize->add_control(
	'footer_socialblock', 
	array(
		'label'    => __( 'Social Block', 'codon' ),
		'description' => __( 'Once enabled, please refresh the customizer to enable the social link fields.', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-socialblock',
		'priority' => 5,
		'type'     => 'radio',
		'choices'  => array(
			'on'  => 'On',
			'off' => 'Off',
		),
	)
);

// only shows the social links if the social bar is enabled
if ( get_theme_mod ('footer-socialblock' ) == 'on' ) {

$wp_customize->add_control(
	'footer_facebook', 
	array(
		'label'    => __( 'Facebook URL', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-facebook',
		'type'     => 'url',
		'priority' => 6,
	)
);

$wp_customize->add_control(
	'footer_gplus', 
	array(
		'label'    => __( 'Google+ URL', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-gplus',
		'type'     => 'url',
		'priority' => 7,
	)
);

$wp_customize->add_control(
	'footer_twitter', 
	array(
		'label'    => __( 'Twitter URL', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-twitter',
		'type'     => 'url',
		'priority' => 8,
	)
);

$wp_customize->add_control(
	'footer_pinterest', 
	array(
		'label'    => __( 'Pinterest URL', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-pinterest',
		'type'     => 'url',
		'priority' => 9,

	)
);

$wp_customize->add_control(
	'footer_youtube', 
	array(
		'label'    => __( 'YouTube URL', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-youtube',
		'type'     => 'url',
		'priority' => 10,

	)
);

$wp_customize->add_control(
	'footer_instagram', 
	array(
		'label'    => __( 'Instagram URL', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-instagram',
		'type'     => 'url',
		'priority' => 11,

	)
);

$wp_customize->add_control(
	'footer_yelp', 
	array(
		'label'    => __( 'Yelp URL', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-yelp',
		'type'     => 'url',
		'priority' => 12,

	)
);

$wp_customize->add_control(
	'footer_tumblr', 
	array(
		'label'    => __( 'Tumblr URL', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-tumblr',
		'type'     => 'url',
		'priority' => 13,

	)
);

$wp_customize->add_control(
	'footer_reddit', 
	array(
		'label'    => __( 'Reddit URL', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-reddit',
		'type'     => 'url',
		'priority' => 14,

	)
);

$wp_customize->add_control(
	'footer_github', 
	array(
		'label'    => __( 'Github URL', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-github',
		'type'     => 'url',
		'priority' => 15,

	)
);

$wp_customize->add_control(
	'footer_skype', 
	array(
		'label'    => __( 'Skype URL', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-skype',
		'type'     => 'url',
		'priority' => 16,

	)
);

$wp_customize->add_control(
	'footer_rss', 
	array(
		'label'    => __( 'RSS URL', 'codon' ),
		'section'  => 'footer',
		'settings' => 'footer-rss',
		'type'     => 'url',
		'priority' => 17,

	)
);

}

}
add_action( 'customize_register', 'codon_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function codon_customize_preview_js() {
	wp_enqueue_script( 'codon_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20141015', true );
}
add_action( 'customize_preview_init', 'codon_customize_preview_js' );

function codon_mod_validation($options) {
// $options will be an array of the theme mod options
// you should return the same array, sanitized
return $options;
}
