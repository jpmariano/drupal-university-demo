(function ($) {
Drupal.anbFeaturesIntro = Drupal.anbFeaturesIntro || {};

Drupal.behaviors.anbFeaturesIntro = {
  attach: function (context) {
    $('.acm-features .row').each(function(){
       $(this).find('.features-item').matchHeights();
    });
  }
};
})(jQuery);
