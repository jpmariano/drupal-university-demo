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
class Hero {

  //put your code here
  public function preprocess(&$vars) {
//    kpr($vars);
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/hero/hero.css',array('group'=>2));
    $style = $vars['field_hero_style'][0]['value'];
    $vars['classes_array'][] = 'section';
    $vars['classes_array'][] = ($style=='style-1') ? 'default' : $style;
    unset($vars['content']['field_hero_style']);
    
    //Fullscreen
    if(!count($vars['field_full_width']) || $vars['field_full_width'][0]['value']=='0'){
//      $vars['classes_array'][] = 'container';
    }else{
//      $vars['classes_array'][] = 'full-screen';
    }
    unset($vars['content']['field_full_width']);
    //Hero theme
    if(count($vars['field_hero_theme'])){
      $vars['classes_array'][] = $vars['field_hero_theme']['0']['value'];
    }
    unset($vars['content']['field_hero_theme']);
    //Content Position
    if(count($vars['field_content_position'])){
      $vars['classes_array'][] = $vars['field_content_position']['0']['value'];
    }
    unset($vars['content']['field_content_position']);
    //Text Alignment
    if(count($vars['field_text_align'])){
      $vars['classes_array'][] = $vars['field_text_align']['0']['value'];
    }
    unset($vars['content']['field_text_align']);
    //Extra Block Classes 
    if(count($vars['field_extra_block_classes'])){
      $vars['classes_array'][] = $vars['field_extra_block_classes']['0']['value'];
    }
    unset($vars['content']['field_extra_block_classes']);
    $vars['heroHeading'] = t($vars['title']);
    if($vars['title']) {
      $vars['classes_array'][] = 'show-intro';
    }
    $vars['heroIntro'] = (!count($vars['body'])) ? '' : $vars['body'][0]['value'];
    unset($vars['content']['body']);
    $styleAttribute=array();
    switch($style){
      case 'style-1':
      case 'style-2':
      case 'style-3':
      case 'style-5':
        $vars['theme_hook_suggestions'][] = 'node__hero__' . str_replace('-', '_', $style);   
        if (count($vars['field_background_image'])){
          $img = file_create_url($vars['field_background_image'][0]['uri']);
          $styleAttribute[] = "background-image: url('$img')";
        }
        unset($vars['content']['field_background_image']);
        if (count($vars['field_image'])){
          $vars['heroImg'] = $vars['content']['field_image'];
        }
        unset($vars['content']['field_image']);
        
        $items = array();
        if(isset($vars['field_hero_buttons']) && count($vars['field_hero_buttons'])){
          $list = $vars['field_hero_buttons'];          
          foreach ($list as $key => $item) {
            $target = $vars['content']['field_hero_buttons'][$key]['entity']['field_collection_item'][$item['value']];
            if(isset($target['field_button_link']) && count($target['field_button_link'])) {
              $items[$key]['url'] = url($target['field_button_link']['#items'][0]['url']);
              $items[$key]['title'] = t($target['field_button_link']['#items'][0]['title']);
            }
            if(isset($target['field_hero_button_class']) && count($target['field_hero_button_class'])) $items[$key]['classes'] = $target['field_hero_button_class']['#items'][0]['value'];
            if(isset($target['field_font_awesome_icon']) && count($target['field_font_awesome_icon'])) $items[$key]['icon'] = $target['field_font_awesome_icon']['#items'][0]['value'];
          }          
        }
        $vars['heroButtons'] = $items;
        unset($vars['content']['field_hero_buttons']);
        break;
      case 'style-4':
        $vars['theme_hook_suggestions'][] = 'node__hero__' . str_replace('-', '_', $style);    
        drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/hero/style-4/hero4.js');
        $vars['heroVideo'] = (!count($vars['field_background_video'])) ? '' : $vars['content']['field_background_video'];
        unset($vars['content']['field_background_video']);
        
        $items = array();
        if(isset($vars['field_hero_buttons']) && count($vars['field_hero_buttons'])){
          $list = $vars['field_hero_buttons'];          
          foreach ($list as $key => $item) {
            $target = $vars['content']['field_hero_buttons'][$key]['entity']['field_collection_item'][$item['value']];
            if(isset($target['field_button_link']) && count($target['field_button_link'])) {
              $items[$key]['url'] = url($target['field_button_link']['#items'][0]['url']);
              $items[$key]['title'] = t($target['field_button_link']['#items'][0]['title']);
            }
            if(isset($target['field_hero_button_class']) && count($target['field_hero_button_class'])) $items[$key]['classes'] = $target['field_hero_button_class']['#items'][0]['value'];
            if(isset($target['field_font_awesome_icon']) && count($target['field_font_awesome_icon'])) $items[$key]['icon'] = $target['field_font_awesome_icon']['#items'][0]['value'];
          }          
        }
        $vars['heroButtons'] = $items;
        unset($vars['content']['field_hero_buttons']);
        break;
    }
    
    if(count($styleAttribute)){
      $vars['attributes_array']['style']=  implode(" ", $styleAttribute);
    }
  }    
  
}
