 
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
		 
		 $( "div.region-header-social-links" ).addClass( "myClass yourClass" );
         
         
         $("ul").children().each(function(i) {
 			 $(this).addClass("list-" + (i+1));
		});
		
		$('li:even').addClass('even');
        $('li:odd').addClass('odd');
        $('li').first().addClass('first');
        
        $('div.sharethis-wrapper span').each(function(i) {
           $(this).addClass("item" + (i+1));
        });
     
        $('.social-net li:first').addClass('first');
        $('.social-net li:first-child').addClass('first');
        $('.social-net li:last-child').addClass('last');
        $('.social-net li:last-child').addClass('last');
        
        $('.region-header').addClass('grid-2');
        $('h3.field-label').addClass('fs-smallest');
        $('.field-type-entityreference').addClass('fs-medium');
        $('.sidebar .block-title').addClass('fs-large');


        

        
        
         
		//Second Image Defaults
	    var $secondfullimage = $('div.field-type-image div.field-items div.field-item.even img').clone();
	    var $secondblockquote = $('div.field-type-image div.field-items div.field-item.even blockquote').clone();
		$('div.field-type-image div.field-items div.field-item.even img').remove(); 
		$('div.field-type-image div.field-items div.field-item.even blockquote').remove(); 
		$('#main-content  div.field-name-body div.field-items div.field-item.odd > p').each(function(i) {
        	$(this).addClass("item" + (i+1));
        });
		$('#main-content  div.field-name-body div.field-items div.field-item.odd  p.item3').after('<p class="second-full-image"></p>');
		 $secondfullimage.appendTo(".page-node #main-content  div.field-name-body div.field-items div.field-item.odd p.second-full-image");
		 $secondblockquote.appendTo(".page-node #main-content  div.field-name-body div.field-items div.field-item.odd p.second-full-image");
		 
		var $second_full_image = $("p.second-full-image");
		$second_full_image.each(function(i) {
		      if ($(this).find("img").length > 0) {
		            
		      } else {
		           $( "p.second-full-image" ).remove();
		     }
		});
		
		
        //$('div.field-type-text h3').addClass('text-size');
		//$('p').addClass('text-size');
		//$('div.field-type-text h3').attr('id', 'text-size');
        //$('p').attr('id', 'text-size');
        
        $('#hideshow').live('click', function(event) {        
         $('#compliance-content').toggle('show');
    	});
    	
        var elm_class = '.btn-btt'; // Adjust this accordingly. 

		//Check to see if the window is top if not then display button
		$(window).scroll(function(){
			if ($(this).scrollTop() > 300) { // 300px from top
				$(elm_class).fadeIn();
			} else {
				$(elm_class).fadeOut();
			}
		});
	
		//Click event to scroll to top
		$(elm_class).click(function(){
			$('html, body').animate({scrollTop : 0},800);
			return false;
		});
	   
    	
    	
    	
		
	

        

        
        
  }
};


})(jQuery, Drupal, this, this.document);



