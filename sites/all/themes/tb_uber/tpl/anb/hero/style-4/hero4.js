(function ($) {
  Drupal.anbHero4 = Drupal.anbHero4 || {};
  Drupal.anbHero4.calculateHeroContentPosition = function(){
    var height = $('.acm-hero.style-4').height();
    $('.acm-hero.style-4 .hero-content').each(function () {
      var $target = $(this);
      var paddingTop = (height - $target.height()) / 2;
      $target.css('padding-top',paddingTop);
    });
  }

  Drupal.behaviors.anbHero4 = {
    attach: function (context) {
      $(document).ready(function(){
        Drupal.anbHero4.calculateHeroContentPosition();
      });
      $(window).resize(function(){
        Drupal.anbHero4.calculateHeroContentPosition();
      });
    }
  };
})(jQuery);