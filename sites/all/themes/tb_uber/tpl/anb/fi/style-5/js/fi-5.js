(function ($) {
  Drupal.anbFeaturesIntro5 = Drupal.anbFeaturesIntro5 || {};

  Drupal.behaviors.anbFeaturesIntro5 = {
    attach: function (context) {
      //Features Intro 5
      $('.field-name-field-carousel-text > .field-items').cycle({
        fx: 'fade',
        slideExpr: '> .field-item'
      });
      
      //inview events
      $('.node-features-intro, .feature-animate').bind('inview', function (event, visible, visiblePartX, visiblePartY) {
        if (visible) {
          if (visiblePartY == 'bottom' || visiblePartY == 'both') {
            if (!$(this).hasClass('section-mask')) {
              $(this).addClass('inview').trigger('inview');
            }
          }
        }
      });
    }
  };
})(jQuery);
