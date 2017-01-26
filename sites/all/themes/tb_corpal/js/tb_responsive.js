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
      $('#menu-bar-wrapper').hide();
      $('.responsive-menu-button').show();
    }
    else{
      $('.responsive-menu-button').hide();
      $('#menu-bar-wrapper').show();
    }
  }

  Drupal.TBResponsive.initResponsiveMenu = function(){
    Drupal.TBResponsive.updateResponsiveMenu();
    $('.tb-main-menu-button').bind('click',function(e){
      var target = $('#menu-bar-wrapper');
      if(target.css('display') == 'none') {
        target.css({display: 'block'});          
      }
      else {
        target.css({display: 'none'});
      }
    });
  }
  
  /*
   * Implement responsive for View slideshow
   */
  Drupal.TBResponsive.setSlideshowHeight = function() {
    var imgs = $('#slideshow-wrapper .view .views-field img')
    if(imgs.length) {
      if(!Drupal.TBResponsive.slideshowSize) {
        var img = new Image();
        img.src = $(imgs[0]).attr('src');
        Drupal.TBResponsive.getImageSize(img);
        setTimeout(Drupal.TBResponsive.setSlideshowHeight, 200)
        return;
      }

      var page_width = $('#page').width();
      var slideshowWrapper = $('#slideshow-wrapper');
      if(page_width < Drupal.TBResponsive.supportedScreens[3]) {
        var width = Drupal.TBResponsive.slideshowSize.width;
        var height = Drupal.TBResponsive.slideshowSize.height;
        var new_height = Math.floor(page_width * height / width);
        $('#slideshow-wrapper .view .views-field img, #slideshow-wrapper .view .views_slideshow_cycle_main, #slideshow-wrapper .views-slideshow-cycle-main-frame-row, #slideshow-wrapper .views-slideshow-cycle-main-frame').css({height: new_height + "px"});
        var wrapperHeight = new_height - (85 * new_height /height);
        slideshowWrapper.height(wrapperHeight);
      }
      else {
        $('#slideshow-wrapper .view .views-field img, #slideshow-wrapper .view .views_slideshow_cycle_main, #slideshow-wrapper .views-slideshow-cycle-main-frame-row, #slideshow-wrapper .views-slideshow-cycle-main-frame').css({height: Drupal.TBResponsive.slideshowSize.height + "px"});
        slideshowWrapper.height(Drupal.TBResponsive.slideshowSize.height - 85);
      }
    }
  }
  Drupal.TBResponsive.setSidebarSlideshowHeight = function() {
    $height = 0;
    $('.sidebar .views-slideshow-cycle-main-frame').cycle('destroy');
    $('.sidebar .views-slideshow-cycle-main-frame .views-slideshow-cycle-main-frame-row').each(function() {
      if ($(this).css('display') != 'none') {
        $(this).find('.views-field').each(function() {
          h = $(this).position().top + $(this).outerHeight();
          if(h > $height) {
            $height = h;
          };        	
        });
      }
    });
    
	if ($('.sidebar .views-slideshow-controls-bottom').length) {
	  img_height = $('.sidebar .views-slideshow-cycle-main-frame img').height();
	  img_width = $('.sidebar .views-slideshow-cycle-main-frame img').width();
	  if(img_height && img_width) {
		$('.sidebar .views-slideshow-cycle-main-frame').css({'height': ($height + 30) + "px", 'width': img_width + "px"});
	  }
	}
	$('.sidebar .views-slideshow-cycle-main-frame').cycle();
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

  Drupal.TBResponsive.matchHeights = function(){
    var windowWidth = window.innerWidth ? window.innerWidth : $(window).width();        
    $('#panel-fifth-wrapper .grid-inner').matchHeights();
    if(windowWidth > Drupal.TBResponsive.supportedScreens[3]){
      $('#main-content .grid-inner, #sidebar-first-wrapper .grid-inner:first').matchHeights(); 
      $('#panel-first-wrapper .views-view-grid .views-col .grid-inner').matchHeights();
    } else {
      if(windowWidth < Drupal.TBResponsive.supportedScreens[2]){
        $('#panel-fifth-wrapper .grid-inner').clearMinHeight();
      }
      $('#main-content .grid-inner:first, #sidebar-first-wrapper .grid-inner:first').clearMinHeight();      
    }           
  }

  Drupal.behaviors.actionTBResponsive = {
    attach: function (context) {
      $(window).load(function(){
        Drupal.TBResponsive.initResponsiveMenu();
        Drupal.TBResponsive.setSlideshowHeight();
        if($('.sidebar .views-slideshow-cycle-main-frame').length) {
          Drupal.TBResponsive.setSidebarSlideshowHeight();
        }
        Drupal.TBResponsive.matchHeights();
      	Drupal.TBResponsive.toolbar = $('#toolbar').length ? $("#toolbar") : false;
        $(window).resize(function(){        
          $('body').css({'padding-top': Drupal.TBResponsive.toolbar ? (Drupal.TBResponsive.toolbar.height() - (Drupal.TBResponsive.IE8 ? 10 : 0)) : 0});
          
          var windowWidth = window.innerWidth ? window.innerWidth : $(window).width();
          if(windowWidth != Drupal.TBResponsive.oldWindowWidth){
            Drupal.TBResponsive.oldWindowWidth = windowWidth;
            Drupal.TBResponsive.updateResponsiveMenu();                                    
            Drupal.TBResponsive.setSlideshowHeight();
            Drupal.TBResponsive.matchHeights();
            if($('.sidebar .views-slideshow-cycle-main-frame').length) {
              Drupal.TBResponsive.setSidebarSlideshowHeight();
            }
          }
          window.setTimeout(function() {
        	$('#modalBackdrop').css('width', '100%');
          }, 500);
        });
      });      
    }
  };
})(jQuery);
