<?php
/**
 * The codon header
 *
 * @package codon
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( is_admin_bar_showing() && get_theme_mod ('header-style') == 'topbar' ) {
	// fix for wp toolbar/foundation top bar conflict
	echo '<style>.fixed { margin-top: 32px; }</style>';
	}
	?>

<?php 
// class 'fixed' activates the sticky top bar
// remove fixed class for non-sticky top bar
?>

<?php if ( get_theme_mod ('header-style') == 'topbar' ) { ?>
<div class="fixed">
	<nav class="top-bar" data-topbar>
		<ul class="title-area">
			<li class="name">
			<?php if ( get_theme_mod ('codon-topbar-logo') != '' ) { ?>
			<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_theme_mod ('codon-topbar-logo' ); ?>" alt="<?php echo get_bloginfo ('name'); ?> Logo" /></h3></a>
			<?php } else { ?>
			<a href="<?php echo esc_url(home_url('/')); ?>"><h3><?php echo get_bloginfo( 'name' ); ?></h3></a>
			<?php } ?>
			</li>
			<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
		</ul>
		<section class="top-bar-section">

			<?php wp_nav_menu( array( 
				'theme_location' => 'top-menu', 
				'menu_class' => 'nav-menu',
				'items_wrap' => '<ul id="top-navigation" class="right">%3$s</ul>',
				'container' => false,
				'fallback_cb' => 'codon_link_to_menu_editor',
				)
				); 
				?>

		</section>
	</nav>
</div>

<?php } ?>

<?php if ( get_theme_mod ('header-style') == 'traditional' ) {
	// check for the existence of the header widget to change the markup
	if ( is_active_sidebar( 'header-widget' ) == true && get_theme_mod ('header-widget') != 'off' ) {
		$column = '6';
	} else {
		$column = '12';
	}

	if ( get_theme_mod ('header-search' ) == 'on' ) {
		$column = '6';
	}
	?>
	<header id="main-header" role="banner">
		<div id="header-row" class="row collapse">
			<?php do_action ('codon_before_traditional_header'); ?>
			<div class="small-12 columns">
				<div class="medium-<?php echo $column; ?> columns">
					<div id="site-title">
						<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<?php get_template_part ('inc/logo'); ?>
						</a>
					</div>
				<?php if ( get_bloginfo('description') != '' && get_theme_mod ('header-description') == 'on' ) { ?>
					<span id="site-description"><?php bloginfo('description'); ?></span>
				<?php } ?>
				</div>

				<?php if ( $column == '6' ) { ?>
				<div class="medium-6 columns">
				<?php get_search_form(); ?>
				<?php do_action( 'before_widget' ); ?>
				<?php dynamic_sidebar( 'header-widget' ); ?>
				</div>
				<?php } ?>

			</div>
		</div>

		<?php do_action ('codon_after_traditional_header'); ?>

		<div class="main-navigation-wrap">
		<div class="row">
			<div class="small-12 columns">
				<nav class="main-navigation desktop" id="site-navigation">
					<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'codon' ); ?>">
						<?php _e( 'Skip to content', 'codon' ); ?>
					</a>

					<?php // button for mobile main menu ?>
					
					<button class="menu-toggle button small"><?php _e( 'Main Menu', 'codon' ); ?></button>
					<?php wp_nav_menu( array( 
						'theme_location' => 'top-menu', 
						'menu_class' => 'nav-menu',
						)
						); 
						?>
				</nav>
			</div>
		</div>
		</div>

	</header>
	<?php } ?>

<?php // closing container div is in footer.php ?>
<div class="row collapse container">