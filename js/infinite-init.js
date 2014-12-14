/* initializes infinite scroll */
var infinite_scroll = {
		loading: {
			img: "/wp-content/themes/codon/images/loader.gif",
			msgText : '',
			finishedMsg: 'the end',
			behavior: 'manual',
			speed: 'slow',
		},
		"nextSelector":"#post-nav a",
		"navSelector":"#post-nav",
		"itemSelector":".column-posts",
		"contentSelector":"#content"
	};
	jQuery( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll );
	
// unbinds to load manually
jQuery('#content').infinitescroll('unbind');

// hides nav links
jQuery('#post-nav').css ( 'display', 'none' );

// loads posts on action
jQuery('#infinite-target').on('click', function(e) {
  e.preventDefault();
	jQuery('#content').infinitescroll('retrieve');
});