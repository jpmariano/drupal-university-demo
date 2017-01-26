<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FeatureIntro
 *
 * @author WIN
 */
class FeaturesIntro {
  protected $style;

  public function preprocess(&$variables) {
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/fi/css/fi-default.css');
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/fi/css/fi.css');
    drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/fi/js/jquery.matchHeights.min.js');
    drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/fi/js/fi.js');

    $style = $variables['field_fi_style'][0]['value'];
    $variables['classes_array'][] = ($style == 'style-1') ? 'default '.$style : $style;
    $variables['classes_array'][] = 'section';
    unset($variables['content']['field_fi_style']);
    $variables['theme_hook_suggestions'][] = 'node__features_intro__' . str_replace('-', '_', $style);
    $variables['attributes_array']['style'] = array();
    if(isset($variables['field_background_color'])){
      $bgColor = (count($variables['field_background_color']) == 0) ? FALSE : $variables['field_background_color'][0]['rgb'];
      $variables['attributes_array']['style'][]= 'background-color: ' . $bgColor;
      unset($variables['content']['field_background_color']);
    }
    switch ($style) {
      case 'style-1':
        $this->preprocess_node_style1($variables);
        break;
      case 'style-2':
        $this->preprocess_node_style2($variables);
        break;
      case 'style-3':
        $this->preprocess_node_style3($variables);
        break;
      case 'style-4':
        $this->preprocess_node_style4($variables);
        break;
      case 'style-5':
        $this->preprocess_node_style5($variables);
        break;
      case 'style-7':
      case 'style-8':
        $this->preprocess_node_style7($variables);
        break;
          default :
        break;
    }

    $variables['attributes_array']['style'] = implode(";",$variables['attributes_array']['style']);
  }

  private function preprocess_node_style1(&$variables){
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/fi/style-1/css/features-intro.css');
    $variables['columnWidth'] = 'col-md-' . (12 / $variables['field_number_of_columns'][0]['value']);
    unset($variables['content']['field_number_of_columns']);
    $variables['description'] = $variables['fi_body'][0]['value'];
    unset($variables['content']['fi_body']);
    $list = $variables['field_feature_details'];
    $items = array();
    foreach ($list as $key => $item) {
      $target = $variables['content']['field_feature_details'][$key]['entity']['field_collection_item'][$item['value']];
      if (isset($target['field_font_awesome_icon']))
        $items[$key]['icon'] = $target['field_font_awesome_icon'][0]['#markup'];
      if (isset($target['field_feature_image']))
        $items[$key]['img'] = $target['field_feature_image'];
      if (isset($target['field_feature_title']))
        $items[$key]['title'] = $target['field_feature_title'];
      if (isset($target['field_feature_description']))
        $items[$key]['desc'] = $target['field_feature_description'];
    }
    $variables['features'] = $items;
    unset($variables['content']['field_feature_details']);
  }

  private function preprocess_node_style2(&$variables){
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/fi/style-1/css/features-intro.css');
    $variables['columnWidth'] = 'col-md-' . (12 / $variables['field_number_of_columns'][0]['value']);
    unset($variables['content']['field_number_of_columns']);
    $variables['description'] = $variables['fi_body'][0]['value'];
    unset($variables['content']['fi_body']);
    $list = $variables['field_feature_details'];
    $items = array();
    foreach ($list as $key => $item) {
      $target = $variables['content']['field_feature_details'][$key]['entity']['field_collection_item'][$item['value']];
      if (isset($target['field_font_awesome_icon']))
        $items[$key]['icon'] = $target['field_font_awesome_icon'][0]['#markup'];
      if (isset($target['field_feature_image']))
        $items[$key]['img'] = $target['field_feature_image'];
      if (isset($target['field_feature_title']))
        $items[$key]['title'] = $target['field_feature_title'];
      if (isset($target['field_feature_description']))
        $items[$key]['desc'] = $target['field_feature_description'];
    }
    $variables['features'] = $items;
    unset($variables['content']['field_feature_details']);
  }

  private function preprocess_node_style3(&$variables){
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/fi/style-1/css/features-intro.css');
    $variables['columnWidth'] = 'col-md-' . (12 / $variables['field_number_of_columns'][0]['value']);
    unset($variables['content']['field_number_of_columns']);
    $variables['description'] = $variables['fi_body'][0]['value'];
    unset($variables['content']['fi_body']);
    $list = $variables['field_feature_details'];
    $items = array();
    foreach ($list as $key => $item) {
      $target = $variables['content']['field_feature_details'][$key]['entity']['field_collection_item'][$item['value']];
      if (isset($target['field_font_awesome_icon']))
        $items[$key]['icon'] = $target['field_font_awesome_icon'][0]['#markup'];
      if (isset($target['field_feature_image']))
        $items[$key]['img'] = $target['field_feature_image'];
      if (isset($target['field_feature_title']))
        $items[$key]['title'] = $target['field_feature_title']['#items'][0]['value'];
      if (isset($target['field_feature_description']))
        $items[$key]['desc'] = $target['field_feature_description']['#items'][0]['value'];
    }
    $variables['features'] = $items;
    unset($variables['content']['field_feature_details']);
  }

  private function preprocess_node_style4(&$variables){
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/fi/style-1/css/features-intro.css');
    $variables['description'] = $variables['fi_body'][0]['value'];
    unset($variables['content']['fi_body']);
    $list = $variables['field_feature_details'];
    $items = array();
    foreach ($list as $key => $item) {
      $target = $variables['content']['field_feature_details'][$key]['entity']['field_collection_item'][$item['value']];
      if (isset($target['field_font_awesome_icon']))
        $items[$key]['icon'] = $target['field_font_awesome_icon'][0]['#markup'];
      if (isset($target['field_feature_image']))
        $items[$key]['img'] = $target['field_feature_image'];
      if (isset($target['field_feature_title']))
        $items[$key]['title'] = $target['field_feature_title']['#items'][0]['value'];
      if (isset($target['field_feature_description']))
        $items[$key]['desc'] = $target['field_feature_description']['#items'][0]['value'];
    }
    $variables['features'] = $items;
    unset($variables['content']['field_feature_details']);
  }

  private function preprocess_node_style5(&$variables){
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/fi/style-5/css/fi-5.css');
    drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/fi/style-5/js/jquery.cycle.all.js', 'file');
    drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/fi/style-5/js/jquery.inview.min.js', 'file');
    drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/fi/style-5/js/fi-5.js', 'file');
    $variables['smallText'] = $variables['content']['field_introduction_sub_title'][0]['#markup'];
    unset($variables['content']['field_introduction_sub_title']);
    $variables['carouselText'] = $variables['content']['field_carousel_text'];
    unset($variables['content']['field_carousel_text']);
    $variables['bigText'] = $variables['content']['field_introduction_title'][0]['#markup'];
    unset($variables['content']['field_introduction_title']);
    $variables['animationDelay'] = (count($variables['field_animation_delay'])) ? $variables['content']['field_animation_delay'][0]['value'] : 200;
    unset($variables['content']['field_animation_delay']);
    if (count($variables['field_fi_image'])) {
      $variables['attributes_array']['style'][] = " background-image: url('" . file_create_url($variables['field_fi_image'][0]['uri']) . "')";
      unset($variables['content']['field_fi_image']);
    }
    $list = $variables['field_feature_details'];
    $items = array();
    foreach ($list as $key => $item) {
      $target = $variables['content']['field_feature_details'][$key]['entity']['field_collection_item'][$item['value']];
      if (isset($target['field_font_awesome_icon']))
        $items[$key]['icon'] = $target['field_font_awesome_icon'][0]['#markup'];
      if (isset($target['field_feature_image']))
        $items[$key]['img'] = $target['field_feature_image'];
      if (isset($target['field_feature_title']))
        $items[$key]['title'] = $target['field_feature_title'][0]['#markup'];
      if (isset($target['field_feature_description']))
        $items[$key]['desc'] = $target['field_feature_description'][0]['#markup'];
    }
    $variables['features'] = $items;
    unset($variables['content']['field_feature_details']);
  }

  private function preprocess_node_style7(&$variables){
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/fi/style-1/css/features-intro.css');
    $variables['description'] = $variables['fi_body'][0]['value'];
    unset($variables['content']['fi_body']);
    if (count($variables['field_fi_image'])) {
      $variables['featured_img'] = $variables['content']['field_fi_image'];
      unset($variables['content']['field_fi_image']);
    }
    $list = $variables['field_feature_details'];
    $items = array();
    foreach ($list as $key => $item) {
      $target = $variables['content']['field_feature_details'][$key]['entity']['field_collection_item'][$item['value']];
      if (isset($target['field_font_awesome_icon']))
        $items[$key]['icon'] = $target['field_font_awesome_icon'][0]['#markup'];
      if (isset($target['field_feature_image']))
        $items[$key]['img'] = $target['field_feature_image'];
      if (isset($target['field_feature_title']))
        $items[$key]['title'] = $target['field_feature_title']['#items'][0]['value'];
      if (isset($target['field_feature_description']))
        $items[$key]['desc'] = $target['field_feature_description']['#items'][0]['value'];
    }
    $variables['features'] = $items;
    unset($variables['content']['field_feature_details']);
  }

}
