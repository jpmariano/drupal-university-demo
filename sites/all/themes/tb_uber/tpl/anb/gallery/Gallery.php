<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Gallery
 *
 * @author WIN
 */
class Gallery {

  //put your code here
  public static function preprocess(&$variables) {
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/gallery/css/gallery.css');
    drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/gallery/js/isotope.pkgd.min.js', 'file');
    drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/gallery/js/imagesloaded.pkgd.min.js', 'file');
    drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/gallery/js/gallery.js', 'file');

    $style = isset($variables['field_gallery_style'][0]['value']) ? $variables['field_gallery_style'][0]['value'] : '';
    $variables['classes_array'][] = ($style == 'style-1') ? 'default' : $style;
    $variables['theme_hook_suggestions'][] = 'node__gallery__' . str_replace('-', '_', $style);
    $variables['classes_array'][] = 'section';
    $variables['itemClasses'] = '';
    if (isset($variables['field_gallery_full_width']) && (!count($variables['field_gallery_full_width']) || $variables['field_gallery_full_width'][0]['value'] == '0')) {
      $variables['classes_array'][] = 'container';
    }
    $variables['gutter'] = (count($variables['field_gutter_setting'])) ? $variables['field_gutter_setting'][0]['value'] : 0;
    $variables['maskSetting'] = (count($variables['field_mask_setting'])) ? $variables['field_mask_setting'][0]['value'] : '';
    $variables['animationSetting'] = (count($variables['field_animation_setting'])) ? $variables['field_animation_setting'][0]['value'] : '';
    $variables['itemClasses'] .= ' ' . $variables['animationSetting'];

    if (count($variables['field_hover_animation'])) {
      $variables['classes_array'][] = 'style-' . $variables['field_hover_animation'][0]['value'];
      unset($variables['content']['field_hover_animation']);
    }
    if (count($variables['field_button_link'])) {
      $link = $variables['content']['field_button_link'];
      if (count($variables['field_button_class'])) {
        $classes = $variables['field_button_class'][0]['value'];
        if (isset($link[0]['#element']['attributes']['class'])) {
          $classes .= ' ' . $link[0]['#element']['attributes']['class'];
        }
        $link[0]['#element']['attributes']['class'] = $classes;
      }
      $variables['galleryItemLink'] = $link;
      unset($variables['content']['field_button_link']);
      unset($variables['content']['field_button_class']);
    }

    $variables['galleryDesc'] = (!(isset($variables['gallery_body']) && count($variables['gallery_body']))) ? FALSE : $variables['body'][0]['value'];
    $list = $variables['field_gallery_item_details'];
    $items = array();
    foreach ($list as $key => $item) {
      $target = $variables['content']['field_gallery_item_details'][$key]['entity']['field_collection_item'][$item['value']];
      if (isset($target['field_gallery_item_width']))
        $items[$key]['width'] = $target['field_gallery_item_width']['#items'][0]['value'] .' col-xs-12';
      if (isset($target['field_gallery_item_image']))
        $items[$key]['img'] = $target['field_gallery_item_image'];
      if (isset($target['field_gallery_item_link'])) {
        $items[$key]['link'] = $target['field_gallery_item_link'];
        $items[$key]['url'] = url($target['field_gallery_item_link'][0]['#element']['url']);
      }
      if (isset($target['field_gallery_item_description']))
        $items[$key]['desc'] = $target['field_gallery_item_description'];
    }
    $variables['galleries'] = $items;

    unset($variables['content']['field_gallery_item_details']);
    unset($variables['content']['field_gallery_full_width']);
    unset($variables['content']['field_gallery_style']);
    unset($variables['content']['field_animation_setting']);
    unset($variables['content']['field_mask_setting']);
    unset($variables['content']['field_gutter_setting']);
    unset($variables['content']['body']);
  }

}
