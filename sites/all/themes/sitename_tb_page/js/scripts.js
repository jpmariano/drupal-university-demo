
/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {


// To understand behaviors, see https://drupal.org/node/756722#behaviors
Drupal.behaviors.my_custom_behavior = {
  attach: function(context, settings) {

        //Insert your Jquery Scripts
         // Responsive Tables
     	$('div.node-content th').attr('data-hide', 'phone,tablet');
     	$('div.node-content th:first-child').removeAttr( "data-hide" );
		$( "table" ).addClass( "footable" );
		$('.footable').footable();
		
		//Responsive Video
		 $("#main-content").fitVids();
		
		//Second Image Defaults
	    var $secondfullimage = $('div.field-type-image div.field-items div.field-item.even img').clone();
	    var $secondblockquote = $('div.field-type-image div.field-items div.field-item.even blockquote').clone();
		$('div.field-type-image div.field-items div.field-item.even img').remove(); 
		$('div.field-type-image div.field-items div.field-item.even blockquote').remove(); 
		$('#main-content div.node-content div.field-name-body div.field-items div.field-item.odd > p').each(function(i) {
        $(this).addClass("item" + (i+1));
        });
		$('#main-content div.node-content div.field-name-body div.field-items div.field-item.odd  p.item3').after('<p class="second-full-image"></p>');
		$secondfullimage.appendTo("#main-content div.node-content div.field-name-body div.field-items div.field-item.odd p.second-full-image");
		$secondblockquote.appendTo("#main-content div.node-content div.field-name-body div.field-items div.field-item.odd p.second-full-image");

		
  }
};


})(jQuery, Drupal, this, this.document);
