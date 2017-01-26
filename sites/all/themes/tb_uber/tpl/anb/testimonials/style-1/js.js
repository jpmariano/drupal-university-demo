/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($) {
Drupal.anbTestimonialsStyle1 = Drupal.anbTestimonialsStyle1 || {};

Drupal.behaviors.anbTestimonialsStyle1 = {
  attach: function (context) {
    $('.field-name-field-testimonial-details > .field-items').cycle({
      fx: 'fade',
      slideExpr:'> .field-item'
    });   
  }
};
})(jQuery);

