(function ($) {
Drupal.TBUber = Drupal.TBUber || {};
Drupal.TBUber.toolbar = false;
Drupal.TBUber.IE8 = navigator.userAgent.search(/MSIE 8.0/) != -1;

Drupal.TBUber.calculateTopMargin = function () {
  return Drupal.TBUber.toolbar ? (Drupal.TBUber.toolbar.height() - (Drupal.TBUber.IE8 ? 10 : 0)) : 0;
}
Drupal.TBUber.btnToTop = function () {
  if ($(window).scrollTop()) {
    $('#back-to-top').fadeIn(1000);
  }
  else {
    $('#back-to-top').fadeOut(1000);
  }
}
  
Drupal.TBUber.initOffCanvasSidebar = function(){
//  var $width = $('.uber-off-canvas').width();
  $('.off-canvas-toggle').bind('click', function(){
    var page = $('#page');
    if(page.hasClass('off-canvas-open')){
      $('#page').removeClass('off-canvas-open');
    }else{
      $('#page').addClass('off-canvas-open');
    }
  });
  
  $('#page-content > .page-content-overlay, #right-sidebar-wrapper .uber-off-canvas-header .close').bind('click',function(){
    $('#page').removeClass('off-canvas-open');
  });
}

Drupal.behaviors.actionTBUber = {
  attach: function (context) {
    Drupal.TBUber.toolbar = $('#toolbar').length ? $("#toolbar") : false;
    $('body').css({'padding-top': Drupal.TBUber.calculateTopMargin()});
    $('#back-to-top a').smoothScroll();
    Drupal.TBUber.initOffCanvasSidebar();
    $(window).scroll(function(){
      Drupal.TBUber.btnToTop();
    });
    $(window).resize(function(){
      $('body').css({'padding-top': Drupal.TBUber.calculateTopMargin()});
    });
  }
};
})(jQuery);
