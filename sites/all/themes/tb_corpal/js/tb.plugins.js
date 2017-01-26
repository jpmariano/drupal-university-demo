(function($) {
  $.fn.placeholder = function(params) { 
    var $this = $(this);
    if($this.val() == "") {
      $this.val(params['value']);
    }
    $this.focus(function(){
      if(this.value == params['value']) {
        this.value='';
      }
    }).blur(function(){
      if(this.value == '') {
        this.value = params['value'];
      }
    });
  };
  $.fn.clearMinHeight = function() {
    $(this).css('min-height', '0px');
  }
  
  $.fn.passwordPlaceHolder = function(params) {
    id = $(this).attr('id');
    class_name = $(this).attr('class');
    ele_name = $(this).attr('name');
    tmp_id = id + "-tmp";
    tmp_name = ele_name + "-tmp";
    tmp_class = class_name;
    $(this).after('<input type="text" class="' + tmp_class + '" maxlength="60" size="15" name="' + tmp_name + '" id="' + tmp_id + '" value="' + Drupal.t('Password') + '"/>');
    $(this).hide();
    $('#' + tmp_id).focus(function(){
        $(this).hide();
        $('#' + id).show().focus();
    });
    $('#' + id).blur(function(){
      if($(this).val() == '') {
        $(this).hide();
        $('#' + tmp_id).show();
      }
    });
  };
})(jQuery);
