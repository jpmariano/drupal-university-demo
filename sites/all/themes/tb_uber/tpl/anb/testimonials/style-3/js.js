/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($) {
Drupal.anbTestimonialsStyle3 = Drupal.anbTestimonialsStyle3 || {};

Drupal.behaviors.anbTestimonialsStyle3 = {
  attach: function (context) {
    $('.field-name-field-testimonial-details-3 > .field-items').cycle({
      fx: 'fade',
      slideExpr:'> .field-item'
    });   
  }
};
})(jQuery);

