<?php 
/**
 * logo template file
 * @package codon
 */
?>

<?php if ( get_theme_mod ('codon-logo') != '' ):
// shows the uploaded logo if present
// falls back to blog name
?>
<img src="<?php echo get_theme_mod ('codon-logo'); ?>" alt="<?php echo get_bloginfo ('name'); ?> Logo" />
<?php else : ?>
	<h2><?php echo get_bloginfo( 'name' ); ?></h2>
<?php endif; ?>
