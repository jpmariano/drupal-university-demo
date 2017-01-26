/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($) {
Drupal.anbTestimonialsStyle4 = Drupal.anbTestimonialsStyle4 || {};

Drupal.behaviors.anbTestimonialsStyle4 = {
  attach: function (context) {
    $('.node-testimonials.style-4 .testimonial-text').cycle({
      fx: 'fade',
      slideExpr:'> .quote-item',
      pagerEvent: 'mouseover',
      pager: '.author-avatars',
      // callback fn that creates a thumbnail to use as pager anchor 
      pagerAnchorBuilder: function(idx, slide) { 
        return '.author-avatars > .author-img:eq('+idx+')'; 
      }
    });   
  }
};
})(jQuery);

