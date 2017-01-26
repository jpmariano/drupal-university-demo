(function ($) {
  Drupal.uberStatistic = Drupal.uberStatistic || {};

  Drupal.behaviors.uberStatistic = {
    attach: function (context) {
      //inview events
      $('.node-statistic, .feature-animate').bind('inview', function (event, visible, visiblePartX, visiblePartY) {
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