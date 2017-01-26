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
      $('#menu-bar-wrapper .responsive-menu-button').show();
      $('#menu-bar-wrapper .block-content').eq(0).hide();
      
    }
    else{
      $('#menu-bar-wrapper .responsive-menu-button').hide();
      $('#menu-bar-wrapper .block-content').eq(0).show();
    }
  }
  
  Drupal.TBResponsive.initQuicktabs = function() {      
      if (($('ul.quicktabs-style-nostyle').length == 1) && ($('.responsive-menu-quicktabs').length == 0)) {
          var html = '<a title="Navigation Icon" href="javascript:void(0);" class="responsive-menu-quicktabs">Navigation</a>';
          $('ul.quicktabs-style-nostyle').before(html);
          Drupal.TBResponsive.updateQuicktabs();
          Drupal.TBResponsive.initResponsiveQuicktabs();
      }
      }
  Drupal.TBResponsive.updateQuicktabs = function(){
    var windowWidth = window.innerWidth ? window.innerWidth : $(window).width();
    if(windowWidth < Drupal.TBResponsive.supportedScreens[3]){     
      //Quicktabs
      $('.responsive-menu-quicktabs').show();
      $('ul.quicktabs-style-nostyle').hide();
      
    }
    else{
      //Quicktabs
      $('.responsive-menu-quicktabs').hide();
      $('ul.quicktabs-style-nostyle').show();
    }
  }
  Drupal.TBResponsive.initResponsiveQuicktabs = function(){
    $('.responsive-menu-quicktabs').bind('click',function(e){        
      var target = $('ul.quicktabs-style-nostyle').eq(0);
      if(target.css('display') == 'none') {
        target.css({display: 'block'});          
      }
      else {
        target.css({display: 'none'});
      }
    });
  }
  
  //Isotope
  Drupal.TBResponsive.initIsotope = function() {      
      if (($('#isotope-options ul.#filters').length == 1) && ($('.responsive-menu-quicktabs').length == 0)) {
          var html = '<a title="Navigation Icon" href="javascript:void(0);" class="responsive-menu-quicktabs">Navigation</a>';
          $('#isotope-options ul.#filters').before(html);
          Drupal.TBResponsive.updateIsotope();
          Drupal.TBResponsive.initResponsiveIsotope();
      }
      }
  Drupal.TBResponsive.updateIsotope = function(){
    var windowWidth = window.innerWidth ? window.innerWidth : $(window).width();
    if(windowWidth < Drupal.TBResponsive.supportedScreens[3]){     
      //Quicktabs
      $('.responsive-menu-quicktabs').show();
      $('#isotope-options ul.#filters').hide();
      
    }
    else{
      //Quicktabs
      $('.responsive-menu-quicktabs').hide();
      $('#isotope-options ul.#filters').show();
    }
  }
  Drupal.TBResponsive.initResponsiveIsotope = function(){
    $('.responsive-menu-quicktabs').bind('click',function(e){        
      var target = $('#isotope-options ul.#filters').eq(0);
      if(target.css('display') == 'none') {
        target.css({display: 'block'});          
      }
      else {
        target.css({display: 'none'});
      }
    });
  }
  
  Drupal.TBResponsive.initResponsiveMenu = function(){
    Drupal.TBResponsive.updateResponsiveMenu();
    $('#menu-bar-wrapper .tb-main-menu-button').bind('click',function(e){        
      var target = $('#menu-bar-wrapper .block-content').eq(0);
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
//      setTimeout(Drupal.TBResponsive.updateSlideshowSize, 200);
//      return; // do nothing at the first time
    }  
    
    slideshow.cycle('destroy');
    var width = $('#slideshow-wrapper .container').eq(0).width();
    var height = width * Drupal.TBResponsive.slideshowSize.height / Drupal.TBResponsive.slideshowSize.width;
    $('#slideshow-wrapper .views-slideshow-cycle-main-frame-row, #slideshow-wrapper .views-slideshow-cycle-main-frame-row img, #slideshow-wrapper .views-slideshow-cycle-main-frame').height(height).width(width);
    slideshow.cycle();
    
  }
  
  Drupal.TBResponsive.updateSlideshowInMainContent = function(){
    var slideshow = $('#main-wrapper .main-slideshow .views-slideshow-cycle-main-frame');
    if(slideshow.length == 0) return;
    var imgs = slideshow.find('img');
    if(imgs.length && !Drupal.TBResponsive.slideshowSize) {
      var img = new Image();
      img.src = $(imgs[0]).attr('src');
      Drupal.TBResponsive.getImageSize(img);
    }  
    
    slideshow.cycle('destroy');
    var width = $('#main-wrapper .container').eq(0).width();
    var height = width * Drupal.TBResponsive.slideshowSize.height / Drupal.TBResponsive.slideshowSize.width;
    $('#main-wrapper .main-slideshow .views-slideshow-cycle-main-frame-row, #main-wrapper .main-slideshow .views-slideshow-cycle-main-frame-row img, #main-wrapper .main-slideshow .views-slideshow-cycle-main-frame').height(height).width(width);
    slideshow.cycle();
    
  }
  
  Drupal.behaviors.actionTBResponsive = {
    attach: function (context) {
      $(window).load(function(){
        Drupal.TBResponsive.initResponsiveMenu();
        Drupal.TBResponsive.updateSlideshowSize();
        Drupal.TBResponsive.updateSlideshowInMainContent();
        Drupal.TBResponsive.initQuicktabs();
        Drupal.TBResponsive.initIsotope();
      	Drupal.TBResponsive.toolbar = $('#toolbar').length ? $("#toolbar") : false;
        //Quick tabs
        
        $(window).resize(function(){     
          // when administration toolbar is displayed
          $('body').css({'padding-top': Drupal.TBResponsive.toolbar ? (Drupal.TBResponsive.toolbar.height() - (Drupal.TBResponsive.IE8 ? 10 : 0)) : 0});
          
          var windowWidth = window.innerWidth ? window.innerWidth : $(window).width();
          if(windowWidth != Drupal.TBResponsive.oldWindowWidth){
            Drupal.TBResponsive.oldWindowWidth = windowWidth;
            Drupal.TBResponsive.updateResponsiveMenu();   
            Drupal.TBResponsive.updateSlideshowSize();
            Drupal.TBResponsive.updateSlideshowInMainContent();
            
            //Quick tabs
            Drupal.TBResponsive.updateQuicktabs();
            Drupal.TBResponsive.initResponsiveQuicktabs();
            //Isotope
            Drupal.TBResponsive.updateIsotope();
            Drupal.TBResponsive.initResponsiveIsotope();
          }
        });
      }); 
      
    }
  };
})(jQuery);
