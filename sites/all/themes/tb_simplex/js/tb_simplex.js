(function ($) {
  Drupal.TBSimplex = Drupal.TBSimplex || {};
  Drupal.TBSimplex.backToTopButton = null;
  Drupal.TBSimplex.IE8 = $.browser.msie && parseInt($.browser.version, 10) === 8;

  Drupal.TBSimplex.transformWebformElementTitles = function(){
    $('.webform-client-form').find('input:not(:submit, :hidden), textarea').each(function(){
      var label = $(this).parents('.form-item').find('label');
      label.hide();
      var text = label.text();
      $(this).placeholder({
        value:text
      });
    });
  }

  Drupal.TBSimplex.matchHeights = function(){
    $('#block-system-main .view-about-us .views-row').each(function(){
      $(this).find('.views-field-body').matchHeights();
    });
    //PRICING TABLE page
    $('.hosting-pricing-table .views-fieldset').each(function(){
      $(this).matchHeights();
    });
  
    $('.hosting-pricing-table .views-row').each(function(){
      $('.hosting-pricing-table .views-row').find('.grid  ul').each(function(index){
        $('.hosting-pricing-table .views-row').find('.grid  ul li:nth-child('+index+')').matchHeights();
      });
    });  
    
    $('.theme-pricing-table .views-row').each(function(){
      $('.theme-pricing-table .views-row').find('.grid  ul').first().find('li').each(function(index){
        $('.theme-pricing-table .views-row').find('.grid  ul li:nth-child('+index+')').matchHeights();            
      });
    });      
    //Fix css margin -2px    
    $('.theme-pricing-table .views-field-title').matchHeights();    
    $('.theme-pricing-table .views-field-title').eq(-1).height($('.theme-pricing-table .views-field-title').eq(-2).height());
    
    $('#panel-sixth-wrapper .panel-column').matchHeights();
    
    // Testimonials Page
    $('.view-grid-testimonials .views-row').each(function(){
      $(this).find('.views-field-body').matchHeights();
    });
  }

  Drupal.TBSimplex.changePagerTitle = function(){
    $('.pager .pager-first a').text(Drupal.t('First'));
    $('.pager .pager-previous a').text(Drupal.t('Previous'));
    $('.pager .pager-next a').text(Drupal.t('Next'));
    $('.pager .pager-last a').text(Drupal.t('Last'));
  }

  Drupal.TBSimplex.btnToTop = function(){
    var current_top = $(document).scrollTop();
    if(current_top !=0) {
      Drupal.TBSimplex.backToTopButton.fadeIn(300);
    }
    else {
      Drupal.TBSimplex.backToTopButton.fadeOut(500);
    }
  }

  Drupal.behaviors.actionTBSimplex = {
    attach: function (context) {
      $('.search-form input').placeholder({
        value:Drupal.t('Search')
        });
    
      if(Drupal.TBSimplex.IE8) {
        if($('body.page-homepage2, body.page-homepage4').length > 0) {
          $('body.page-homepage2, body.page-homepage4').css({
            '-ms-filter': "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + Drupal.settings.tb_simplex_domain + Drupal.settings.basePath + Drupal.settings.pathToTheme + "/images/bg-body.jpg', sizingMethod='scale')"
            });
          $('body.page-homepage2, body.page-homepage4').css({
            'filter': "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + Drupal.settings.tb_simplex_domain + Drupal.settings.basePath + Drupal.settings.pathToTheme + "/images/bg-body.jpg', sizingMethod='scale')"
            });
        }
        else {
          $('body').css({
            'background': "none"
          });
        }
      }
    
      Drupal.TBSimplex.backToTopButton = $('.btn-btt');
      Drupal.TBSimplex.backToTopButton.smoothScroll();
      Drupal.TBSimplex.btnToTop();
    
      // for taxonomy term page
      $('.page-taxonomy #block-system-main .node').eq(0).css('border-top','none');
    
      Drupal.TBSimplex.transformWebformElementTitles();
      Drupal.TBSimplex.matchHeights();  
      Drupal.TBSimplex.changePagerTitle();
      $(window).scroll(function(){
        Drupal.TBSimplex.btnToTop();
      });
    }
  };
})(jQuery);
