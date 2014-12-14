jQuery(document).ready(function(){
	jQuery('#top-return').on('click', function(){
		jQuery('html, body').animate({scrollTop:0}, 'slow');
		return false;
		});
});