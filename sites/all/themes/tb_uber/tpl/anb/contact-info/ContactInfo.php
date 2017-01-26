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
class ContactInfo {

  //put your code here
  public function preprocess(&$vars) {
//        kpr($vars);
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/contact-info/contact.css',array('group'=>2));
    $style = $vars['field_contact_style'][0]['value'];
    $vars['classes_array'][] = 'section';
    $vars['classes_array'][] = ($style=='style-1') ? 'default '.$style : $style;
    unset($vars['content']['field_contact_style']);
    
    //Fullscreen
    $vars['content_class'] = array();
    if(!count($vars['field_full_width']) || $vars['field_full_width'][0]['value']=='0'){
      $vars['content_class'][] = 'container';
    }
    unset($vars['content']['field_full_width']);
    //Embeded Google Map
    if(isset($vars['field_embed_google_map']) && count($vars['field_embed_google_map'])){
      $vars['embedGMap'] = $vars['field_embed_google_map'][0]['value'];
    }
    unset($vars['content']['field_embed_google_map']);
    //Map Image
    if(isset($vars['field_map_image']) && count($vars['field_map_image'])){
      $vars['mapImg'] = $vars['content']['field_map_image'];
    }
    unset($vars['content']['field_map_image']);
    //Contact Info Position
    if(isset($vars['field_contact_info_position']) && count($vars['field_contact_info_position'])){
      $vars['contactInfoPos'] = $vars['field_contact_info_position'][0]['value'];
    }
    unset($vars['content']['field_contact_info_position']);
    //Extra Info
    $vars['NumberOfCols'] = 1;
    if(isset($vars['field_extra_contact_info']) && count($vars['field_extra_contact_info'])){
      $vars['extraInfo'] = $vars['field_extra_contact_info'];
      $vars['NumberOfCols'] += count($vars['field_extra_contact_info']);
    }
    unset($vars['content']['field_extra_contact_info']);
    //Body
    $vars['description'] = (!count($vars['body'])) ? '' : $vars['body'][0]['value'];
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
    
    $vars['theme_hook_suggestions'][] = 'node__contact_info__' . str_replace('-', '_', $style);   
        
    $items = array();
    if(isset($vars['field_contact_details']) && count($vars['field_contact_details'])){
      $list = $vars['field_contact_details'];          
      foreach ($list as $key => $item) {
        $target = $vars['content']['field_contact_details'][$key]['entity']['field_collection_item'][$item['value']];
        if(isset($target['field_font_awesome_icon']) && count($target['field_font_awesome_icon'])) 
          $items[$key]['icon'] = $target['field_font_awesome_icon']['#items'][0]['value'];
        if(isset($target['field_contact_name']) && count($target['field_contact_name'])) 
          $items[$key]['name'] = t($target['field_contact_name']['#items'][0]['value']);
        if(isset($target['field_contact_detail']) && count($target['field_contact_detail'])) 
          $items[$key]['detail'] = t($target['field_contact_detail']['#items'][0]['value']);
      }          
    }
    $vars['contacts'] = $items;
    unset($vars['content']['field_contact_details']);
    
    $vars['attributes_array']['style'] = implode('; ', $vars['attributes_array']['style']);
    $vars['content_class'] = implode('; ', $vars['content_class']);
//    kpr($vars);
  }    
  
}
