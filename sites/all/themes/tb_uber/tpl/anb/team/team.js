(function ($) {
  Drupal.uberTeam = Drupal.uberTeam || {};

  Drupal.behaviors.uberTeam = {
    attach: function (context) {
      $('.acm-teams').each(function(){
        $(this).find('.item').matchHeights();
      });
    }
  };
})(jQuery);