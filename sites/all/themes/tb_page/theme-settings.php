<?php
/**
 * @file
 * Theme setting callbacks for the nucleus theme.
 */

// Impliments hook_form_system_theme_settings_alter().
function tb_page_form_system_theme_settings_alter(&$form, $form_state) {
  $form['nucleus']['regions_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Region Settings'),
    '#weight' => 5,
  );
  
  global $theme_key;
  $theme_data = list_themes();
//  $regions = $theme_data[$theme_key]->info['regions'];
  $regions = system_region_list($theme_key, REGIONS_VISIBLE);
  $region_styles = array(''=>'None');
  $region_styles += $theme_data[$theme_key]->info['region_styles'];
  foreach($regions as $key => $val){
    if(substr_count($key, 'page_')){
      $form['nucleus']['regions_settings'][$key] = array(
        '#type' => 'select',
        '#title' => t($val),
        '#default_value' => theme_get_setting($key) ? theme_get_setting($key) : '',
        '#options' => $region_styles,
      );
    }
  }  
}

