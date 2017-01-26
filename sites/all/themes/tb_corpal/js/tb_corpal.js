(function ($) {
Drupal.behaviors.actionTBCorpal = {
  attach: function (context) {
    $('#block-system-main .pager-first a').text(Drupal.t('First'));
    $('#block-system-main .pager-previous a').text(Drupal.t('Prev'));
    $('#block-system-main .pager-next a').text(Drupal.t('Next'));
    $('#block-system-main .pager-last a').text(Drupal.t('Last'));
    $('.form-item-search-block-form input').placeholder({value: Drupal.t('Search site here...')});
    $('#search-form #edit-keys').placeholder({value: Drupal.t('Search site here...')});

    $('input[name="name"]').each(function() {
      if($(this).hasClass('added-placeholder') == false) {
        $(this).placeholder({value: Drupal.t('Username')});
        $(this).addClass('added-placeholder');
      }
    });

    $('input[name="pass"]').each(function() {
      if($(this).hasClass('added-placeholder') == false) {
        $(this).passwordPlaceHolder({value: Drupal.t('Password')});
        $(this).addClass('added-placeholder');
      }
    });
    if ($.browser.webkit) {
      $('input[name="name"], input[name="pass"]').attr('autocomplete', 'off');
    }
    
    $('#header #search-block-form #edit-actions input[type="submit"]').click(function() {
      display = $('#header #search-block-form input[name="search_block_form"]').parent().css('display');
      value = $('#header #search-block-form input[name="search_block_form"]').val();
      
      if(value == Drupal.t('Search site here...')) {
    	if(display == 'none') {
    	  $('#header #search-block-form input[name="search_block_form"]').parent().css('display', 'block');
    	}
    	else {
    	  $('#header #search-block-form input[name="search_block_form"]').parent().css('display', 'none');
    	}
    	return false;
      }
      
    })
  }
};
})(jQuery);
