jQuery(document).ready(function() {		
	//pt_media_slideshow();
	setTimeout('pt_media_slideshow()',500);
});

function pt_media_slideshow()
{
	var imgWidth = jQuery('#gallery-item').find('img').width();
	var imgHeight = jQuery('#gallery-item').find('img').height();
	
	// Set width and height
	var pt_gallery_width = imgWidth > 0 ? imgWidth : jQuery('input[name=imgWidth]').val();
	var pt_gallery_height = imgHeight > 0 ? imgHeight : jQuery('input[name=imgWidth]').val()/2;
	var pt_excerpt_width = pt_gallery_width - 10;

	jQuery('#pt-slider').css({
		'width': pt_gallery_width + 'px',
		'height': pt_gallery_height + 'px'
	});

	jQuery('#mask-excerpt, #gallery-excerpt, #gallery-excerpt li').css({
		'width': pt_gallery_width + 'px',
		'height': '80px'
	});
	
	//Call the gallery function to run the slideshow, 8000 = change to next image after 6 seconds
	setInterval('pt_media_gallery()',8000);
}

function pt_media_gallery()
{
	//if no IMGs have the show class, grab the first image
	var current_image = (jQuery('#gallery-item li.show').length ? jQuery('#gallery-item li.show') : jQuery('#gallery-item li:first'));
	var current_excerpt = (jQuery('#gallery-excerpt li.show').length ? jQuery('#gallery-excerpt li.show') : jQuery('#gallery-excerpt li:first'));

	//Get next image, if it reached the end of the slideshow, rotate it back to the first image
	var next_image = ((current_image.next().length) ? current_image.next() : jQuery('#gallery-item li:first'));
	var next_excerpt = ((current_excerpt.next().length) ? current_excerpt.next() : jQuery('#gallery-item li:first'));

	//Hide the current image
	current_image.removeClass('show');
	current_excerpt.removeClass('show');

	//Hide the current image
	next_image.addClass('show');
	next_excerpt.addClass('show');

	jQuery('#mask-gallery').scrollTo(next_image, 800);
	jQuery('#mask-excerpt').scrollTo(next_excerpt, 800);
}
