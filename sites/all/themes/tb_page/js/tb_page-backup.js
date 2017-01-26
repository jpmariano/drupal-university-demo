(function ($) {
  Drupal.TBPage = Drupal.TBPage || {};
  Drupal.TBPage.currentRegion = null;
  Drupal.TBPage.regions = null;
  Drupal.TBPage.currentTop = false;
  Drupal.TBPage.clickScrolling = false;
  Drupal.TBPage.prevWindowWidth = 0;
  Drupal.TBPage.toolbarHeight = 0;
  Drupal.TBPage.supportedScreens = [0.5, 479.5, 719.5, 959.5, 1049.5];

  Drupal.TBPage.comparePos = function(x, pos, delta) {
    return x > pos - delta & x < pos + delta;
  }

  /*
   * Get position status by region in comparision with scroll position
   * @param DOM region
   * @return integer
   *  0: out of scope
   *  1: region top matches screen top
   *  2: region bottom matches screen bottom
   */
  
  Drupal.TBPage.getMax = function(a, b) {
    return a > b ? a : b;
  }

  Drupal.TBPage.getMin = function(a, b) {
    return a < b ? a : b;
  }
	  
  Drupal.TBPage.getRegionQuantity = function(region){
    if (!region) {
      return 0;
    }
    var region_top = $(region).offset().top;
    var region_bottom = region_top + $(region).height();
    var body_padding_top = parseInt($('body').css('padding-top'));
    var screen_top = $(window).scrollTop() + body_padding_top + $("#header-wrapper").height();
    var screen_bottom = $(window).scrollTop() + $(window).height();
    var top = Drupal.TBPage.getMax(region_top, screen_top);
    var bottom = Drupal.TBPage.getMin(region_bottom, screen_bottom);
    return bottom - top;
  }
  
  Drupal.TBPage.activeMenu = function(region) {
    var str = region.replace('-wrapper','');
    $('#onepage-menu a').removeClass('active');
    $('#' + str + "-menu a").addClass('active');
    // change hash
    var position = $(window).scrollTop();
    window.location.hash = '#'+region;
    $(window).scrollTop(position);
  }

  Drupal.TBPage.setCurrentRegion = function(region){
    if(Drupal.TBPage.currentRegion != region){
      Drupal.TBPage.activeMenu(region);
      Drupal.TBPage.currentRegion = region;
    }
  }
  
  Drupal.TBPage.scrollSpy_ = function(){
    if(Drupal.TBPage.clickScrolling) {
      return;
    }
    var regions = Drupal.TBPage.regions;
    var active_region = false;
    var max = 0;

    for(var i = 0; i < regions.length; i ++ ) {
      var quantity = Drupal.TBPage.getRegionQuantity(regions[i]);
      if(max < quantity) {
        max = quantity;
        active_region = regions[i];
      }
    }
    Drupal.TBPage.setCurrentRegion($(active_region).attr('id'));
  }

  Drupal.TBPage.scrollSpy = function(){
	var regions = Drupal.TBPage.regions;
    var active_region = false;
    var max = 0;

    for(var i = 0; i < regions.length; i ++ ) {
      var quantity = Drupal.TBPage.getRegionQuantity(regions[i]);
      if(max < quantity) {
        max = quantity;
        active_region = regions[i];
      }
    }
    Drupal.TBPage.setCurrentRegion($(active_region).attr('id'));
  }

  Drupal.TBPage.initContactForm = function(){
    $('#edit-submitted-contact-name').placeholder({value:'Name*'});
    $('#edit-submitted-contact-email').placeholder({value: 'Email*'});
    $('#edit-submitted-project-budget').placeholder({value: 'Budget*'});
    $('#edit-submitted-project-timeframe').placeholder({value: 'Timeframe*'});
    $('#edit-submitted-contact-message').placeholder({value: 'Message'});
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
    $('#header .tb-main-menu-button').click(function(e){
        var target = $('#onepage-menu');
        if(target.css('display') == 'none') {
          target.css({display: 'block'});
        }
        else {
          target.css({display: 'none'});
        }
      });
  }
  
  Drupal.behaviors.actionTBPage = {
    attach: function (context) {     
      Drupal.TBPage.initContactForm();
      Drupal.TBPage.toolbarHeight = $('#header').height() + $('#toolbar').height();
      Drupal.TBPage.initResponsiveMenu();
      
      var hash = window.location.hash;
      if(hash != ''){
        var pos = $(hash).offset().top - Drupal.TBPage.toolbarHeight;
        $('html, body').animate({scrollTop: pos}, 0);
      }
      
      // Smooth scroll
      $('.arrow-down a').each(function(){
        var $this = $(this);
        var nextRegion = $this.parents('.onepage-region').next('.onepage-region');
        $this.attr('href', '#'+nextRegion.attr('id'));
      });
      $('.btn-btt, .arrow-down a').smoothScroll({
        offset: -Drupal.TBPage.toolbarHeight
      });
      $('#onepage-menu a').smoothScroll({
        offset: - Drupal.TBPage.toolbarHeight,
        afterScroll: function(options) {
          var list = $(options.link).attr('href').split('/');
          var id = list[list.length - 1];
          id = id.replace('#','');
          Drupal.TBPage.setCurrentRegion(id);          
        }
      });
            
      Drupal.TBPage.regions = $('#page .onepage-region');
      Drupal.TBPage.scrollSpy();
      
      $(window).scroll(function(){
        Drupal.TBPage.scrollSpy();
        Drupal.TBPage.currentTop = $(window).scrollTop();
      });
      
      Drupal.TBPage.prevWindowWidth = $(window).width();
      $(window).resize(function(){
        $('body').css({'padding-top': Drupal.TBWall.toolbar ? (Drupal.TBWall.toolbar.height() - (Drupal.TBWall.IE8 ? 10 : 0)) : 0});
        var width = $(window).width() - Drupal.TBPage.prevWindowWidth;
        Drupal.TBPage.prevWindowWidth = $(window).width();       
        var portfolio = $('#page_portfolio');
        portfolio.css('width', portfolio.width() + width);
        portfolio.find('.jcarousel').jcarousel('reload');
        
        Drupal.TBPage.updateResponsiveMenu();
      });
    }
  };
})(jQuery);
