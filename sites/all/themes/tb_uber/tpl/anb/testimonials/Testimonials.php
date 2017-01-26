<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Testimonials
 *
 * @author williampham
 * @return
 *  Array
 */
class Testimonials {

  //put your code here
  public function preprocess(&$variables) {
    $style = $variables['field_style'][0]['value'];
    $variables['theme_hook_suggestions'][] = 'node__testimonials__' . str_replace('-', '_', $style);
    $variables['contentClasses'] = array();
    if (!count($variables['field_full_width']) || $variables['field_full_width'][0]['value'] == '0') {
      $variables['contentClasses'][] = 'container';
    }

    $variables['backgroundColor'] = (count($variables['field_background_color']) == 0) ? FALSE : $variables['field_background_color'][0]['rgb'];
    $variables['attributes_array']['style'] = 'background: ' . $variables['backgroundColor'];
    $variables['textColor'] = (count($variables['field_text_color']) == 0) ? FALSE : $variables['field_text_color'][0]['rgb'];
    $variables['authorTextColor'] = (count($variables['field_author_text_color']) == 0) ? FALSE : $variables['field_author_text_color'][0]['rgb'];
    $variables['classes_array'][] = ($style == 'style-1') ? 'default' : $style;
    $variables['classes_array'][] = 'section';

    drupal_add_js(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/testimonials/js/jquery.cycle.all.js', 'file');
    drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/testimonials/css/testimonials.css');

    switch ($style) {
      case 'style-1':
        $this->prepareStyle1($variables);
        break;

      case 'style-2':
        $this->prepareStyle2($variables);
        break;

      case 'style-3':
        $this->prepareStyle3($variables);
        break;

      case 'style-4':
        $this->prepareStyle4($variables);
        break;

      case 'style-5':
        $this->prepareStyle5($variables);

      default :
        break;
    }
    $variables['contentClasses'] = implode(" ", $variables['contentClasses']);
    unset($variables['content']['field_background_color']);
    unset($variables['content']['field_text_color']);
    unset($variables['content']['field_author_text_color']);
    unset($variables['content']['field_full_width']);
    unset($variables['content']['field_style']);
  }

  private function prepareStyle1(&$variables){
    $list = $variables['field_testimonial_details'];
    $items = array();
    foreach ($list as $key => $item) {
      $target = $variables['content']['field_testimonial_details'][$key]['entity']['field_collection_item'][$item['value']];
      if (isset($target['field_testimonial']))
        $items[$key]['testimonial'] = $target['field_testimonial'][0]['#markup'];
      if (isset($target['field_author']))
        $items[$key]['author'] = $target['field_author'][0]['#markup'];
    }
    $variables['testimonials'] = $items;
    unset($variables['content']['field_testimonial_details']);
  }

  private function prepareStyle2(&$variables){
    $list = $variables['field_testimonial_details_2'];
    $items = array();
    foreach ($list as $key => $item) {
      $target = $variables['content']['field_testimonial_details_2'][$key]['entity']['field_collection_item'][$item['value']];
      if (isset($target['field_testimonial']))
        $items[$key]['testimonial'] = $target['field_testimonial'][0]['#markup'];
      if (isset($target['field_author']))
        $items[$key]['author'] = $target['field_author'][0]['#markup'];
      if (isset($target['field_author_image']))
        $items[$key]['author-img'] = file_create_url($target['field_author_image']['#items'][0]['uri']);
      if (isset($target['field_author_position']))
        $items[$key]['author-title'] = $target['field_author_position'][0]['#markup'];
    }
    $variables['testimonials'] = $items;
    unset($variables['content']['field_testimonial_details_2']);
  }

  private function prepareStyle3(&$variables){
    $list = $variables['field_testimonial_details_3'];
    $items = array();
    foreach ($list as $key => $item) {
      $target = $variables['content']['field_testimonial_details_3'][$key]['entity']['field_collection_item'][$item['value']];
      if (isset($target['field_testimonial']))
        $items[$key]['testimonial'] = $target['field_testimonial'][0]['#markup'];
      if (isset($target['field_author']))
        $items[$key]['author'] = $target['field_author'][0]['#markup'];
    }
    $variables['testimonials'] = $items;
    unset($variables['content']['field_testimonial_details_3']);
  }

  private function prepareStyle4(&$variables){

    $list = $variables['field_testimonial_details_4'];
    $items = array();
    foreach ($list as $key => $item) {
      $target = $variables['content']['field_testimonial_details_4'][$key]['entity']['field_collection_item'][$item['value']];
      if (isset($target['field_testimonial']))
        $items[$key]['testimonial'] = $target['field_testimonial'][0]['#markup'];
      if (isset($target['field_author']))
        $items[$key]['author'] = $target['field_author'][0]['#markup'];
      if (isset($target['field_author_image']))
        $items[$key]['author-img'] = file_create_url($target['field_author_image']['#items'][0]['uri']);
      if (isset($target['field_author_position']))
        $items[$key]['author-title'] = $target['field_author_position'][0]['#markup'];
    }
    $variables['testimonials'] = $items;
    unset($variables['content']['field_testimonial_details_4']);
  }

  private function prepareStyle5(&$variables){

    $list = $variables['field_testimonial_details_2'];
    $items = array();
    foreach ($list as $key => $item) {
      $target = $variables['content']['field_testimonial_details_2'][$key]['entity']['field_collection_item'][$item['value']];
      if (isset($target['field_testimonial']))
        $items[$key]['testimonial'] = $target['field_testimonial'][0]['#markup'];
      if (isset($target['field_author']))
        $items[$key]['author'] = $target['field_author'][0]['#markup'];
      if (isset($target['field_author_image']))
        $items[$key]['author-img'] = file_create_url($target['field_author_image']['#items'][0]['uri']);
      if (isset($target['field_author_position']))
        $items[$key]['author-title'] = $target['field_author_position'][0]['#markup'];
    }
    $variables['testimonials'] = $items;
    unset($variables['content']['field_testimonial_details_2']);
  }

}
