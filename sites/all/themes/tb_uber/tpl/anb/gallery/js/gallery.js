(function ($) {
  Drupal.anbGallery = Drupal.anbGallery || {};

  Drupal.behaviors.anbGallery = {
    attach: function (context) {
      imagesLoaded('.acm-gallery.default .isotope', function () {
        $('.acm-gallery.default .isotope').isotope({
          itemSelector: '.item'
        });
      });
//      imagesLoaded('.acm-gallery .isotope', function () {
//        $('.acm-gallery .isotope').masonry({
//          itemSelector: '.item'
//        });
//      });

    }
  };
})(jQuery);
