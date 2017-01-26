# Paste this code on top of page.tpl.php

 dpm( get_defined_vars() ); --- list all variables available 
 
 dpm( debug_backtrace() );  --- output an array of each function your page contents went through before they were output to the browser, plus it shows the location of these functions.
 
# dpr – Shortcut for dprint_r.
# dvr – Similar to dpr, but uses var_dump instead of print_r.
# dpm – Similar to dpr but print_r's a variable as a message using drupal_set_message.
# dvm – Similar to dpm but uses var_dump instead of print_r.
