(function ($) {
  Drupal.TBResponsive = Drupal.TBResponsive || {};
  Drupal.TBResponsive.supportedScreens = [0.5, 479.5, 719.5, 959.5, 1049.5];
  Drupal.TBResponsive.oldWindowWidth = 0;
  Drupal.TBResponsive.IE8 = $.browser.msie && parseInt($.browser.version, 10) === 8;
  Drupal.TBResponsive.toolbar = false;
  Drupal.TBResponsive.slideshowSize = false;
  
  Drupal.TBResponsive.updateResponsiveMenu = function(){
    var windowWidth = window.innerWidth ? window.innerWidth : $(window).width();
    if(windowWidth < Drupal.TBResponsive.supportedScreens[3]){
      $('#menu-bar-wrapper .container').eq(0).hide();
      $('#menu-bar-wrapper .responsive-menu-button').show();
    }
    else{
      $('#menu-bar-wrapper .responsive-menu-button').hide();
      $('#menu-bar-wrapper .container').eq(0).show();
    }
  }
  
  Drupal.TBResponsive.initResponsiveMenu = function(){
    Drupal.TBResponsive.updateResponsiveMenu();
    $('#menu-bar-wrapper .tb-main-menu-button').bind('click',function(e){
      var target = $('#menu-bar-wrapper .container').eq(0);
      if(target.css('display') == 'none') {
        target.css({display: 'block'});          
      }
      else {
        target.css({display: 'none'});
      }
    });
  }
  
  Drupal.TBResponsive.getImageSize = function(img) {
    if(img.height == 0) {
      setTimeout(function() {
          Drupal.TBResponsive.getImageSize(img);
      }, 200);
      return;
    }
    if(!Drupal.TBResponsive.slideshowSize) {
      Drupal.TBResponsive.slideshowSize = {height: img.height, width: img.width};
    }
  }
  
  Drupal.TBResponsive.updateSlideshowSize = function(){
    var slideshow = $('#slideshow-wrapper .views-slideshow-cycle-main-frame');
    if(slideshow.length == 0) return;
    var imgs = slideshow.find('img');
    if(imgs.length && !Drupal.TBResponsive.slideshowSize) {
      var img = new Image();
      img.src = $(imgs[0]).attr('src');
      Drupal.TBResponsive.getImageSize(img);
      setTimeout(Drupal.TBResponsive.updateSlideshowSize, 200);
      return; // do nothing at the first time
    }  
    
    slideshow.cycle('destroy');
    var width = $('#slideshow-wrapper .container').eq(0).width();
    var height = width * Drupal.TBResponsive.slideshowSize.height / Drupal.TBResponsive.slideshowSize.width;
    $('#slideshow-wrapper .views-slideshow-cycle-main-frame-row, #slideshow-wrapper .views-slideshow-cycle-main-frame-row img, #slideshow-wrapper .views-slideshow-cycle-main-frame').height(height).width(width);
    slideshow.cycle();
    
  }
  
  Drupal.behaviors.actionTBResponsive = {
    attach: function (context) {
      $(window).load(function(){
        Drupal.TBResponsive.initResponsiveMenu();
        Drupal.TBResponsive.updateSlideshowSize();
        
      	Drupal.TBResponsive.toolbar = $('#toolbar').length ? $("#toolbar") : false;
        $(window).resize(function(){     
          // when administration toolbar is displayed
          $('body').css({'padding-top': Drupal.TBResponsive.toolbar ? (Drupal.TBResponsive.toolbar.height() - (Drupal.TBResponsive.IE8 ? 10 : 0)) : 0});
          
          var windowWidth = window.innerWidth ? window.innerWidth : $(window).width();
          if(windowWidth != Drupal.TBResponsive.oldWindowWidth){
            Drupal.TBResponsive.oldWindowWidth = windowWidth;
            Drupal.TBResponsive.updateResponsiveMenu();   
            Drupal.TBResponsive.updateSlideshowSize();
          }
        });
      });      
    }
  };
})(jQuery);
