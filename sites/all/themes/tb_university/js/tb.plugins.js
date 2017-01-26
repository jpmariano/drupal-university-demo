(function($) {
  $.fn.placeholder = function(params) { 
    var $this = $(this);
    if($this.val() == "") {
      $this.val(params['value']);
    }
    $this.focus(function(){
      if(this.value == Drupal.t(params['value'])) {
        this.value='';
      }
    }).blur(function(){
      if(this.value == '') {
        this.value = Drupal.t(params['value']);
      }
    });
  };
  $.fn.clearMinHeight = function() {
    $(this).css('min-height', '0px');
  }
  
  $.fn.passwordPlaceHolder = function(params) {
    var id = $(this).attr('id');
    var class_name = $(this).attr('class');
    var ele_name = $(this).attr('name');
    var tmp_id = id + "-tmp";
    var tmp_name = ele_name + "-tmp";
    var tmp_class = class_name;
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
