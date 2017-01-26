(function ($) {
  Drupal.TBPage = Drupal.TBPage || {};
  Drupal.TBPage.currentRegion = null;
  Drupal.TBPage.regions = null;
  Drupal.TBPage.clickScrolling = false;
  Drupal.TBPage.toolbarHeight = 0;
  Drupal.TBPage.supportedScreens = [0.5, 479.5, 719.5, 959.5, 1049.5];
  Drupal.TBPage.IE8 = $.browser.msie && parseInt($.browser.version, 10) === 8;
  Drupal.TBPage.popupIScroll = false;
  Drupal.TBPage.backToTopButton = null;
  
  Drupal.TBPage.activeMenu = function(region) {
    var str = region.replace('-wrapper','');
    $('#onepage-menu a').removeClass('active');
    $('#' + str + "-menu a").addClass('active');
    // change hash
    var position = $(window).scrollTop();
    window.location.hash = '#'+str;
    $(window).scrollTop(position);
  }

  Drupal.TBPage.setCurrentRegion = function(region){
    if(Drupal.TBPage.currentRegion != region){
      Drupal.TBPage.activeMenu(region);
      Drupal.TBPage.currentRegion = region;
    }
  }
  Drupal.TBPage.iScrollPopupInit = function() {
    el = $('body.tb-page-popup-iframe');
    if(el.length && !Drupal.TBPage.IE8) {
      var height = $(parent.document).find('#cboxLoadedContent').height();
      el.height(height);
      Drupal.TBPage.popupIScroll = new iScroll(el[0], {vScrollbar: true,  scrollbarClass: 'myScrollbar', useTransform: false});
    }
  }

  
  Drupal.TBPage.scrollSpy = function(){
    var regions = Drupal.TBPage.regions;
    var screenTop = $(window).scrollTop();
    var currentRegion = false;
    var delta = Drupal.TBPage.toolbarHeight + 3;
    for(var i = 0; i < regions.length; i ++ ) {
      var region = regions[i];
      var regionTop = $(region).offset().top;
      var regionBottom = $(region).height() + regionTop;
      if(screenTop >= regionTop-delta && screenTop <= regionBottom-delta ){
        currentRegion = region;
        break;
      }
    }
    if(currentRegion) {
      Drupal.TBPage.setCurrentRegion($(currentRegion).attr('id'));
    }
  }
  
  Drupal.TBPage.initContactForm = function(){
    $('.webform-client-form').find('input:not(:submit, :hidden), textarea').each(function(){
      var label = $(this).parents('.form-item').find('label');
      var text = label.text();
      $(this).placeholder({value:text});
    });
  }
  
  Drupal.TBPage.updateResponsiveMenu = function(){
    var windowWidth = window.innerWidth ? window.innerWidth : $(window).width();
    if(windowWidth < Drupal.TBPage.supportedScreens[3]){
      $('#onepage-menu').hide();
      $('#header .responsive-menu-button').show();
    }
    else{
      $('#header .responsive-menu-button').hide();
      $('#onepage-menu').show();
    }
  }
  
  Drupal.TBPage.initResponsiveMenu = function(){
    Drupal.TBPage.updateResponsiveMenu();
    $('#header .tb-main-menu-button').unbind().bind('click',function(e){
      var target = $('#onepage-menu');
      if(target.css('display') == 'none') {
          window.scrollTo(0, 0);
          $('#header-wrapper').css({position: 'absolute'});
          target.css({display: 'block'});          
      }
      else {
          target.css({display: 'none'});
          $('#header-wrapper').css({position: 'fixed'});
      }
    });
  }
  Drupal.TBPage.scrollTo = function(target, options){
    if($(target).length > 0){
      options = $.extend({duration : 0}, options);
      var pos = $(target).offset().top - Drupal.TBPage.toolbarHeight;
      $('html, body').animate({scrollTop: pos}, options.duration, null, options.callback);
    }
  }
  
  Drupal.TBPage.btnToTop = function(){
    if($(window).scrollTop()) {
      Drupal.TBPage.backToTopButton.fadeIn(1000);
    }
    else {
      Drupal.TBPage.backToTopButton.fadeOut(1000);
    }
  }
  
  Drupal.behaviors.actionTBPage = {
    attach: function (context) {     
      Drupal.TBPage.initContactForm();
      Drupal.TBPage.initResponsiveMenu();

      $('#change_skin_menu_wrapper').css('display', 'none');
      $('.tb-skin-menu-icon').parent('li').hover(
        function(){
          $('#change_skin_menu_wrapper').show();
        }, 
        function(){
          $('#change_skin_menu_wrapper').hide();
        });
      
      Drupal.TBPage.toolbarHeight = $('#header').height() + $('#toolbar').height();
      var hash = window.location.hash;
      if(hash != ''){
        Drupal.TBPage.scrollTo(hash+'-wrapper');
      }
      
      // Smooth scroll
      $('.arrow-down a').each(function(){
        var $this = $(this);
        var nextRegion = $this.parents('.onepage-region').next('.onepage-region');
        $this.attr('href', '#'+nextRegion.attr('id'));
      });
      
      $('.btn-btt, .arrow-down a, .onepage-nav, #onepage-menu li a').smoothScroll({
        offset: -Drupal.TBPage.toolbarHeight
      });            
      
      $('#onepage-menu li').bind('click', function(){
        var windowWidth = window.innerWidth ? window.innerWidth : $(window).width();
        if(windowWidth < Drupal.TBPage.supportedScreens[3] && $(this).find('li').length < 1){
          $('#onepage-menu').hide();
          $('#header-wrapper').css({position: 'fixed'});
        }
      });
      // fix the bug: fixed position in ipad
      if(navigator.platform == 'iPad'){
        $(document).bind('touchmove', function(){
          $('#header-wrapper').css({position: 'fixed', top: $('#toolbar').height()});
        });
      }
      
      // fix popup issue when click on anchor
      if(!Drupal.TBPage.IE8){
        $('a, area, input').filter('.colorbox-load').bind('click',function(){
          if(history.pushState) {
            history.pushState("", document.title, window.location.pathname);
          }
          Drupal.TBPage.currentRegion = null;
        });
      }
      
      Drupal.TBPage.regions = $('#page .onepage-region');
      Drupal.TBPage.scrollSpy();
      Drupal.TBPage.backToTopButton = $('.btn-btt');
      Drupal.TBPage.btnToTop();
      $(window).scroll(function(){
        Drupal.TBPage.btnToTop();
        if($(window).width() > Drupal.TBPage.supportedScreens[3]){
          Drupal.TBPage.scrollSpy();
        }else{
          if(history.pushState) {
            history.pushState("", document.title, window.location.pathname);
	      }
          Drupal.TBPage.currentRegion = null;
        }
      });
      
      $(window).resize(function(){
        var windowWidth = window.innerWidth ? window.innerWidth : $(window).width();
        if(Drupal.TBPage.oldWidth != windowWidth){
          Drupal.TBPage.updateResponsiveMenu();
          Drupal.TBPage.oldWidth = windowWidth;
          $('#onepage-menu li a').smoothScroll({
            offset: -Drupal.TBPage.toolbarHeight
          });
        }
      });
      $(window).load(function() {
        Drupal.TBPage.iScrollPopupInit();
      });
    }
  };
})(jQuery);
