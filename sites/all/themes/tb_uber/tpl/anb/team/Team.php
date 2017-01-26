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
class Team {

  //put your code here
  public function preprocess(&$vars) {
    //    kpr($vars);
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/team/team.css',array('group'=>2));
    drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/team/team.js',array('group'=>2));
    $style = $vars['field_team_style'][0]['value'];
    $vars['classes_array'][] = 'section';
    $vars['classes_array'][] = ($style=='style-1') ? 'default' : $style;
    unset($vars['content']['field_team_style']);
    
    //Fullscreen
    $vars['content_class'] = array();
    if(!count($vars['field_full_width']) || $vars['field_full_width'][0]['value']=='0'){
      $vars['content_class'][] = 'container';
    }
    unset($vars['content']['field_full_width']);
    //Number of columns
    if(isset($vars['field_number_of_columns']) && count($vars['field_number_of_columns'])){
      $vars['NumOfCols'] = $vars['field_number_of_columns'][0]['value'];
      unset($vars['content']['field_number_of_columns']);
    }
    //Body
    $vars['description'] = (!count($vars['body'])) ? '' : $vars['body'][0]['value'];
    unset($vars['content']['body']);
    //Background Color
    if(!isset($vars['attributes_array']['style'])) $vars['attributes_array']['style'] = array();
    if(isset($vars['field_background_color']) && count($vars['field_background_color'])){
      $vars['attributes_array']['style'][] = 'background: ' . $vars['field_background_color'][0]['rgb'];
      unset($vars['content']['field_background_color']);
    }
    //Gutter
    if(isset($vars['field_gutter_setting']) && count($vars['field_gutter_setting'])){
      $vars['gutterSetting'] = $vars['field_gutter_setting'][0]['value'];
      unset($vars['content']['field_gutter_setting']);
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
    
    $vars['theme_hook_suggestions'][] = 'node__team__' . str_replace('-', '_', $style);   
        
    $items = array();
    if(isset($vars['field_team_member_details']) && count($vars['field_team_member_details'])){
      $list = $vars['field_team_member_details'];          
      foreach ($list as $key => $item) {
        $target = $vars['content']['field_team_member_details'][$key]['entity']['field_collection_item'][$item['value']];
        if(isset($target['field_member_image']) && count($target['field_member_image'])) 
          $items[$key]['img'] = $target['field_member_image'];
        if(isset($target['field_member_full_name']) && count($target['field_member_full_name'])) 
          $items[$key]['name'] = t($target['field_member_full_name']['#items'][0]['value']);
        if(isset($target['field_member_title']) && count($target['field_member_title'])) 
          $items[$key]['title'] = t($target['field_member_title']['#items'][0]['value']);
        if(isset($target['field_member_intro']) && count($target['field_member_intro'])) 
          $items[$key]['desc'] = $target['field_member_intro']['#items'][0]['value'];
        if(isset($target['field_text_background_color']) && count($target['field_text_background_color'])){
          $items[$key]['textBgColor'] = 'background-color: ' . $target['field_text_background_color']['#items'][0]['rgb'];
        }
        if(isset($target['field_social_contact']) && count($target['field_social_contact'])) {
          $socials = array();
          foreach($target['field_social_contact']['#items'] as $i => $socialItem){
            $socialTarget = $target['field_social_contact'][$i]['entity']['field_collection_item'][$socialItem['value']];
            if(isset($socialTarget['field_social_link']) && count($socialTarget['field_social_link']))
              $socials[$i]['link'] = $socialTarget['field_social_link'][0]['#element']['url'];
            if(isset($socialTarget['field_social_icon']) && count($socialTarget['field_social_icon']))
              $socials[$i]['icon'] = $socialTarget['field_social_icon']['#items'][0]['value'];
          }
          $items[$key]['socials'] = $socials;
        }
      }          
    }
    $vars['members'] = $items;
    unset($vars['content']['field_team_member_details']);
    
    $vars['attributes_array']['style'] = implode('; ', $vars['attributes_array']['style']);
    $vars['content_class'] = implode('; ', $vars['content_class']);
//    kpr($vars);
  }    
  
}
