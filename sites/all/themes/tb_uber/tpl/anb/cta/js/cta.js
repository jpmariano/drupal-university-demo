(function ($) {
  Drupal.uberCTA = Drupal.uberCTA || {};

  Drupal.behaviors.uberCTA = {
    attach: function (context) {
      //Parallax
      var iOS = parseFloat(('' + (/CPU.*OS ([0-9_]{1,5})|(CPU like).*AppleWebKit.*Mobile/i.exec(navigator.userAgent) || [0, ''])[1]).replace('undefined', '3_2').replace('_', '.').replace('_', '')) || false;
      if (!(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || iOS)) {
        if ($('.bg-image').length > 0 || $('.style-tab-1').length > 0) {
          $('.bg-image').parallax("50%", 0.05);
        }
      } else {
        $('.bg-image').css({"background-attachment": "scroll", "background-size": "cover"});
      }
      
      //inview events
      $('.node-cta, .feature-animate').bind('inview', function (event, visible, visiblePartX, visiblePartY) {
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