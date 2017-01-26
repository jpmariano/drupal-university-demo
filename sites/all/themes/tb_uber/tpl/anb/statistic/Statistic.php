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
class Statistic {

  //put your code here
  public function preprocess(&$vars) {
//    kpr($vars);
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/statistic/statistic.css',array('group'=>2));
    drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/statistic/jquery.inview.min.js',array('group'=>2));
    drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/statistic/statistic.plugins.js',array('group'=>2));
    drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/statistic/statistic.js',array('group'=>2));
    $style = $vars['field_statistic_style'][0]['value'];
    unset($vars['content']['field_statistic_style']);
    $vars['classes_array'][] = 'section';
    $vars['classes_array'][] = ($style=='style-1') ? 'default '.$style : $style;
    
    //Fullscreen
    $vars['content_class'] = array();
    if(!count($vars['field_full_width']) || $vars['field_full_width'][0]['value']=='0'){
      $vars['content_class'][] = 'container';
    }
    unset($vars['content']['field_full_width']);
    //Intro text
    $vars['introText'] = (!count($vars['body'])) ? '' : $vars['body'][0]['value'];
    unset($vars['content']['body']);
    //Background Color
    if(!isset($vars['attributes_array']['style'])) $vars['attributes_array']['style'] = array();
    if(isset($vars['field_background_color']) && count($vars['field_background_color'])){
      $vars['attributes_array']['style'][] = 'background: ' . $vars['field_background_color'][0]['rgb'];
      unset($vars['content']['field_background_color']);
    }   
    // Hide Title
    if(isset($vars['field_hide_title']) && count($vars['field_hide_title'])){
      $vars['hideTitle'] = $vars['field_hide_title'][0]['value'];
      unset($vars['content']['field_hide_title']);
    }
    // Extra Block Class
    if(isset($vars['field_extra_block_classes']) && count($vars['field_extra_block_classes'])){
      $vars['classes_array'][] = $vars['field_extra_block_classes'][0]['value'];
      unset($vars['content']['field_extra_block_classes']);
    }
    //Number of columns
    if(isset($vars['field_number_of_columns']) && count($vars['field_number_of_columns'])){
      $vars['NumOfCols'] = $vars['field_number_of_columns'][0]['value'];
      unset($vars['content']['field_number_of_columns']);
    }
    
    $vars['theme_hook_suggestions'][] = 'node__statistic__' . str_replace('-', '_', $style);
        
    $items = array();
    if(isset($vars['field_statistic']) && count($vars['field_statistic'])){
      $list = $vars['field_statistic'];          
      foreach ($list as $key => $item) {
        $target = $vars['content']['field_statistic'][$key]['entity']['field_collection_item'][$item['value']];
        if(isset($target['field_value']) && count($target['field_value'])) 
          $items[$key]['value'] = $target['field_value']['#items'][0]['value'];
        if(isset($target['field_description']) && count($target['field_description'])) 
          $items[$key]['desc'] = $target['field_description']['#items'][0]['value'];
        if(isset($target['field_text_color']) && count($target['field_text_color'])){
          $items[$key]['textColor'] = 'color: ' . $target['field_text_background_color']['#items'][0]['rgb'];
        }
        if(isset($target['field_font_awesome_icon']) && count($target['field_font_awesome_icon'])){
          $items[$key]['icon'] = $target['field_font_awesome_icon']['#items'][0]['value'];
        }
      }          
    }
    $vars['statistics'] = $items;
    unset($vars['content']['field_statistic']);
    
    $vars['attributes_array']['style'] = implode('; ', $vars['attributes_array']['style']);
    $vars['content_class'] = implode('; ', $vars['content_class']);
//    kpr($vars);
  }    
  
}
