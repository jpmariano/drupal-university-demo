<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CTA
 *
 * @author Jhcm1
 */
class CTA {

  //put your code here
  public function preprocess(&$variables) {
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/cta/css/cta.css');
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/cta/css/cta.mobile.vertical.css', array('media'=>'only screen and (max-width:320px)'));
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/cta/css/cta.mobile.css', array('media'=>'only screen and (max-width:767px)'));
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/cta/css/cta.tablet.vertical.css', array('media'=>'only screen and (min-width: 768px) and (max-width: 991px)'));
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/cta/css/cta.tablet.css', array('media'=>'only screen and (min-width: 992px) and (max-width: 1024px)'));
    drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/cta/js/jquery.parallax-1.1.3.js');
    drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/cta/js/jquery.inview.min.js');
    drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/cta/js/cta.js');
    $style = $variables['field_cta_style'][0]['value'];
    unset($variables['content']['field_cta_style']);
    $variables['theme_hook_suggestions'][] = 'node__cta__' . str_replace('-', '_', $style);
    $variables['classes_array'][] = ($style == 'style-1') ? 'default' : $style;
    $variables['classes_array'][] = 'section';
    $attribute_style = '';
    switch ($style) {
      case 'style-1':
        if (count($variables['field_image'])) {
          $variables['classes_array'][] = 'has-photo';
        }

      case 'style-2':
        $variables['imgField'] = (count($variables['field_image']) == 0) ? FALSE : render($variables['content']['field_image']);
        break;

      case 'style-3':
        if (count($variables['field_image'])) {
          $attribute_style = "background-image: url('" . file_create_url($variables['field_image'][0]['uri']) . "');";
        }
        break;

      default :
        break;
    }
    unset($variables['content']['field_image']);
    if(isset($variables['field_extra_block_classes']) && count($variables['field_extra_block_classes'])){
      $variables['classes_array'][] = $variables['field_extra_block_classes'][0]['value'];
    }
    unset($variables['content']['field_extra_block_classes']);
    if (isset($variables['field_cta_background_color']) && count($variables['field_cta_background_color'])) {
      $attribute_style .= "background-color: " . $variables['field_cta_background_color'][0]['rgb'] . ';';
    }
    unset($variables['content']['field_cta_background_color']);
    if ($attribute_style) {
      if (isset($variables['attributes_array']['style'])) {
        $variables['attributes_array']['style'] .= ';' . $attribute_style;
      }
      else {
        $variables['attributes_array']['style'] = $attribute_style;
      }
    }

    $variables['ctaHeading'] = render($variables['title']);
    $variables['ctaIntro'] = (!count($variables['cta_body'])) ? FALSE : $variables['cta_body'][0]['value'];
    unset($variables['content']['cta_body']);
    $list = $variables['field_cta_buttons'];
    $items = array();
    foreach ($list as $key => $item) {
      $target = $variables['content']['field_cta_buttons'][$key]['entity']['field_collection_item'][$item['value']];
      if (isset($target['field_cta_button_link'])) {
        $link = $target['field_cta_button_link'];
        if (isset($target['field_cta_button_class'])) {
          $classes = $target['field_cta_button_class'][0]['#markup'];
          if (isset($link[0]['#element']['attributes']['class'])) {
            $classes .= ' ' . $link[0]['#element']['attributes']['class'];
          }
          $link[0]['#element']['attributes']['class'] = $classes;
        }
        $items[$key]['link'] = $link;
      }
    }
    $variables['ctaButtons'] = $items;
    unset($variables['content']['field_cta_buttons']);
  }

}
