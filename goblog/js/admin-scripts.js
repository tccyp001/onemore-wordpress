jQuery(document).ready(function() {
	// Standard
	var standard = jQuery('#post-format-0:checked').val();
	
	if (standard != '0') {
		jQuery('#standardbox').css('display', 'none');
	}
	
	jQuery('#post-format-0').click( function() {
		jQuery('#standardbox').css('display', 'block');
	});
	
	jQuery('#post-format-video, #post-format-gallery, #post-format-quote, #post-format-aside, #post-format-chat, #post-format-status, #post-format-audio, #post-format-image, #post-format-link').click( function() {
		jQuery('#standardbox').css('display', 'none');
	});
	
	// Image
	var image = jQuery('#post-format-image:checked').val();
	
	if (image != 'image') {
		jQuery('#imagebox').css('display', 'none');
	}
	
	jQuery('#post-format-image').click( function() {
		jQuery('#imagebox').css('display', 'block');
	});
	
	jQuery('#post-format-video, #post-format-gallery, #post-format-quote, #post-format-aside, #post-format-chat, #post-format-status, #post-format-audio, #post-format-0, #post-format-link').click( function() {
		jQuery('#imagebox').css('display', 'none');
	});
	
	// Video
	var video = jQuery('#post-format-video:checked').val();
	
	if (video != 'video') {
		jQuery('#videobox').css('display', 'none');
	}
	
	jQuery('#post-format-video').click( function() {
		jQuery('#videobox').css('display', 'block');
	});
	
	jQuery('#post-format-0, #post-format-gallery, #post-format-quote, #post-format-aside, #post-format-chat, #post-format-status, #post-format-audio, #post-format-image, #post-format-link').click( function() {
		jQuery('#videobox').css('display', 'none');
	});

	// Audio
	var audio = jQuery('#post-format-audio:checked').val();
	
	if (audio != 'audio') {
		jQuery('#audiobox').css('display', 'none');
	}
	
	jQuery('#post-format-audio').click( function() {
		jQuery('#audiobox').css('display', 'block');
	});
	
	jQuery('#post-format-0, #post-format-gallery, #post-format-link, #post-format-aside, #post-format-chat, #post-format-status, #post-format-quote, #post-format-image, #post-format-video').click( function() {
		jQuery('#audiobox').css('display', 'none');
	});

	// Link
	var link = jQuery('#post-format-link:checked').val();
	
	if (link != 'link') {
		jQuery('#linkbox').css('display', 'none');
	}
	
	jQuery('#post-format-link').click( function() {
		jQuery('#linkbox').css('display', 'block');
	});
	
	jQuery('#post-format-0, #post-format-gallery, #post-format-quote, #post-format-aside, #post-format-chat, #post-format-status, #post-format-audio, #post-format-image, #post-format-video').click( function() {
		jQuery('#linkbox').css('display', 'none');
	});

	// Gallery
	var gallery = jQuery('#post-format-gallery:checked').val();
	
	if (gallery != 'gallery') {
		jQuery('#gallerybox').css('display', 'none');
	}
	
	jQuery('#post-format-gallery').click( function() {
		jQuery('#gallerybox').css('display', 'block');
	});
	
	jQuery('#post-format-0, #post-format-quote, #post-format-link, #post-format-aside, #post-format-chat, #post-format-status, #post-format-audio, #post-format-image, #post-format-video').click( function() {
		jQuery('#gallerybox').css('display', 'none');
	});

	// Status
	var status = jQuery('#post-format-status:checked').val();
	
	if (status != 'status') {
		jQuery('#statusbox').css('display', 'none');
	}
	
	jQuery('#post-format-status').click( function() {
		jQuery('#statusbox').css('display', 'block');
	});
	
	jQuery('#post-format-0, #post-format-gallery, #post-format-quote, #post-format-link, #post-format-aside, #post-format-chat, #post-format-audio, #post-format-image, #post-format-video').click( function() {
		jQuery('#statusbox').css('display', 'none');
	});

	// Quote
	var quote = jQuery('#post-format-quote:checked').val();
	
	if (quote != 'quote') {
		jQuery('#quotebox').css('display', 'none');
	}
	
	jQuery('#post-format-quote').click( function() {
		jQuery('#quotebox').css('display', 'block');
	});
	
	jQuery('#post-format-0, #post-format-gallery, #post-format-link, #post-format-aside, #post-format-chat, #post-format-status, #post-format-audio, #post-format-image, #post-format-video').click( function() {
		jQuery('#quotebox').css('display', 'none');
	});
});