<?php

/**
 * @file
 * Override of preprocess functions.
 */

function tb_page_preprocess_html(&$vars) {
  $node_id = drupal_lookup_path('source','404-page');
  if(!empty($node_id)) {
    $parts = explode("/", $node_id);
    $n_id = false;
    if(count($parts) > 1) {
      $n_id = $parts[1];
    }
    if(in_array("html__node__$n_id", $vars['theme_hook_suggestions'])) {
     $vars['theme_hook_suggestions'][] = 'html__404';
    }
  }
  if (count($vars['theme_hook_suggestions']) == 1) {
    if (isset($vars['page']['content']['system_main']['main']['#markup']) &&
            trim($vars['page']['content']['system_main']['main']['#markup']) == t('The requested page "@path" could not be found.', array('@path' => request_uri()))) {
      $vars['theme_hook_suggestions'][] = 'html__404';
    }
  }
  
  if (isset($_GET['tb_page_iframe']) && $_GET['tb_page_iframe'] == 1) {
    $vars['theme_hook_suggestions'][] = 'html__popup_iframe';
  }
}

function tb_page_preprocess_page(&$vars) {
  global $theme_key;
  $theme_data = list_themes();
  $onepage_menus = $theme_data[$theme_key]->info['onepage_menu'];
  $menuDom = '';
  if (count($onepage_menus)) {
    $menuDom = '<ul id="onepage-menu">';
    $flag = (isset($vars['theme_hook_suggestions'][1]) && $vars['theme_hook_suggestions'][1] == 'page__front') ? TRUE : FALSE;
    foreach ($onepage_menus as $key => $val) {
      $formattedKey = str_replace('_', '-', $key);
      $basePath = $vars['is_front'] ? '' : base_path(); // when is outside
      if ($flag) {
        $item = '<li id="' . $formattedKey . '-menu"><a href="' . $basePath . '#' . $formattedKey . '-wrapper" class="active">' . t($val) . '</a></li>';
        $flag = FALSE;
      }
      else{
        $item = '<li id="' . $formattedKey . '-menu"><a href="' . $basePath . '#' . $formattedKey . '-wrapper">' . t($val) . '</a></li>';
      }
      $menuDom .= ($vars['page'][$key] || !$vars['is_front']) ? $item : '';
    }
    if(drupal_lookup_path('source','404-page')){
      $menuDom .= '<li><a href="'.  base_path().'404-page">'.t('404 Page').'</a></li>';
    }    
    
    $vars['page']['show_skins_menu'] = $show_skins_menu = theme_get_setting('show_skins_menu');
    $current_skin = theme_get_setting('skin');
    if (isset($_COOKIE['nucleus_skin'])) {
      $current_skin = $_COOKIE['nucleus_skin'];
    }
    $vars['nucleus_skin_classes'] = !empty($current_skin) ? ($current_skin . "-skin") : "";
    if($show_skins_menu) {
      $skins = nucleus_get_predefined_param('skins', array("default" => t("Default Style")));
      $str = array();
      $str[] = '<div id="change_skin_menu_wrapper" class="change-skin-menu-wrapper wrapper">';
      $str[] = '<ul class="change-skin-menu">';

          foreach ($skins as $skin => $skin_title) {
            $li_class = ($skin == $current_skin ? ($skin . ' active') : $skin);
            $str[] = '<li class="' . $li_class . '"><a href="#change-skin/' . $skin . '" class="change-skin-button color-' . $skin . '">' . t($skin_title) . '</a></li>';
          }
          $str[] = '</ul></div>';
          $vars['page']['show_skins_menu'] = implode("", $str);
    }    
  
    if(isset($vars['page']['show_skins_menu']) && $vars['page']['show_skins_menu']){
      $menuDom .= '<li><a href="javascript: void" class="tb-skin-menu-icon">'.t('Styles').'</a>'.$vars['page']['show_skins_menu'].'</li>';
    }
    $menuDom .= '</ul>';
  }

  $vars['onepage_menu'] = $menuDom;
  
  if (isset($_GET['tb_page_iframe']) && $_GET['tb_page_iframe'] == 1) {
    $vars['theme_hook_suggestions'][] = 'page__popup_iframe';
  }
}

function tb_page_preprocess_region(&$variables) {
  global $theme_key;
  $theme_data = list_themes();
  $onepage_menus = $theme_data[$theme_key]->info['onepage_menu'];
  $region = $variables['region'];
  $variables['onepageRegion'] = '';
  foreach ($onepage_menus as $key => $val){
    if($region == $key) {
      $variables['onepageRegion'] = 'onepage-region';
      break;
    }
  }
  $region_style = theme_get_setting($region);
  $variables['region_style'] = $region_style;
  $grid_info = nucleus_get_grid_setting();
  $grid = $grid_info['grid'];
  $variables['grid'] = $grid;
} 

function tb_page_image_formatter($variables) {
  $item = $variables['item'];
  $image = array(
    'path' => $item['uri'],
  );

  if (array_key_exists('alt', $item)) {
    $image['alt'] = $item['alt'];
  }

  if (isset($item['attributes'])) {
    $image['attributes'] = $item['attributes'];
  }

  if (isset($item['width']) && isset($item['height'])) {
    $image['width'] = $item['width'];
    $image['height'] = $item['height'];
  }

  // Do not output an empty 'title' attribute.
  if (isset($item['title']) && drupal_strlen($item['title']) > 0) {
    $image['title'] = $item['title'];
  }

  if ($variables['image_style']) {
    $image['style_name'] = $variables['image_style'];
    $output = theme('image_style', $image);
  }
  else {
    $output = theme('image', $image);
  }

  // The link path and link options are both optional, but for the options to be
  // processed, the link path must at least be an empty string.
  if (isset($variables['path']['path'])) {
    $path = $variables['path']['path'];
    $options = isset($variables['path']['options']) ? $variables['path']['options'] : array();
    $options += array('attributes' => array('class' => array()));
    $options['attributes']['class'][] = "colorbox-load";
    // When displaying an image inside a link, the html option must be TRUE.
    $options['html'] = TRUE;
    $output = l($output, $path, $options);
  }

  return $output;
}

function tb_page_preprocess_node(&$vars) {
  if(variable_get('clean_url', 0)) {
    $node_url = $vars['node_url'];
    $vars['tb_page_iframe_token'] = (strpos($node_url, "?") !== false) ? "&" : "?";
  }
}

/**
 * Implements hook_css_alter().
 */
function tb_page_js_alter(&$js) {
  if (isset($js[drupal_get_path('module', 'colorbox') . '/js/colorbox_load.js'])) {
    drupal_add_js(drupal_get_path('theme', 'tb_page') . '/js/colorbox_load.js');
  }
}