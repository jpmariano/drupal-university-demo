/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($) {
Drupal.anbTestimonialsStyle2 = Drupal.anbTestimonialsStyle2 || {};

Drupal.behaviors.anbTestimonialsStyle2 = {
  attach: function (context) {
    $('.field-name-field-testimonial-details-2 > .field-items').cycle({
      fx: 'scrollLeft',
      slideExpr:'> .field-item',
      'pager': '#nav',
      // callback fn that creates a thumbnail to use as pager anchor 
      pagerAnchorBuilder: function(idx, slide) { 
        return '#nav > li:eq('+idx+')'; 
      } 
    });   
  }
};
})(jQuery);

