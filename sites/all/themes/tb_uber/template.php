<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function tb_uber_preprocess_html(&$vars){
  drupal_add_html_head_link(array('href'=>'http://fonts.googleapis.com/css?family=Roboto:300', 'rel'=>'stylesheet', 'type'=>'text/css'));

  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/css/html-elements.css');
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/css/forms.css');
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/css/page.css');
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/css/comments.css');
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/css/views.css');
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/css/forums.css');
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/css/fields.css');
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/css/blocks.css');
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/css/navigation.css');
//  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/bootstrap/css/bootstrap.min.css');
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/bootstrap/css/bootstrap-theme.min.css');
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/css/responsive.css');
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/css/uber.bootstrap.css');
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/css/uber.core.css');
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/css/uber.css');
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/css/uber.common.css',array('group'=>1));
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/css/uber.typography.css');
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/css/uber.forms.css');
  drupal_add_css(drupal_get_path('theme', 'tb_uber') . '/tpl/anb/css/off-canvas.css');
  drupal_add_js(drupal_get_path('theme','tb_uber').'/bootstrap/js/bootstrap.js');
  drupal_add_js(drupal_get_path('theme','tb_uber').'/js/jquery.smooth-scroll.js');
}

function tb_uber_preprocess_page(&$vars){
//  kpr($vars);
  $vars['isUberNode'] = false;
  if(isset($vars['node']) &&
          (in_array($vars['node']->type, array('cta', 'gallery', 'testimonials', 'hero', 'team', 'statistic', 'contact_info')) )){
    $vars['title']='';
    $vars['isUberNode'] = true;
  }
  if(isset($vars['node']) && $vars['node']->type=='advanced_page' && $vars['node']->field_hide_title['und'][0]['value']){
    $vars['title']='';
    $vars['isUberNode'] = true;
  }
}

  function tb_uber_preprocess_node(&$vars){
 // kpr($vars);
  if(isset($vars['content']['field_category']) && count($vars['content']['field_category'])){
    $vars['category'] = $vars['content']['field_category'][0];
    unset($vars['content']['field_category']);
  }
  $helper = NULL;
  switch ($vars['type']){
    case 'cta':
      require_once DRUPAL_ROOT.'/'.drupal_get_path('theme', 'tb_uber').'/tpl/anb/cta/CTA.php';
      $helper = new CTA();
      $helper->preprocess($vars);
      break;
    case 'features_intro':
      require_once DRUPAL_ROOT.'/'.drupal_get_path('theme', 'tb_uber').'/tpl/anb/fi/FeaturesIntro.php';
      $helper = new FeaturesIntro();
      $helper->preprocess($vars);
      break;
    case 'gallery':
      require_once DRUPAL_ROOT.'/'.drupal_get_path('theme', 'tb_uber').'/tpl/anb/gallery/Gallery.php';
      $helper = new Gallery();
      $helper->preprocess($vars);
      break;
    case 'testimonials':
      require_once DRUPAL_ROOT.'/'.drupal_get_path('theme', 'tb_uber').'/tpl/anb/testimonials/Testimonials.php';
      $helper = new Testimonials();
      $helper->preprocess($vars);
      break;
    case 'hero':
      require_once DRUPAL_ROOT.'/'.drupal_get_path('theme', 'tb_uber').'/tpl/anb/hero/Hero.php';
      $helper = new Hero();
      $helper->preprocess($vars);
      break;
    case 'team':
      require_once DRUPAL_ROOT.'/'.drupal_get_path('theme', 'tb_uber').'/tpl/anb/team/Team.php';
      $helper = new Team();
      $helper->preprocess($vars);
      break;
    case 'statistic':
      require_once DRUPAL_ROOT.'/'.drupal_get_path('theme', 'tb_uber').'/tpl/anb/statistic/Statistic.php';
      $helper = new Statistic();
      $helper->preprocess($vars);
      break;
    case 'contact_info':
      require_once DRUPAL_ROOT.'/'.drupal_get_path('theme', 'tb_uber').'/tpl/anb/contact-info/ContactInfo.php';
      $helper = new ContactInfo();
      $helper->preprocess($vars);
      break;
    case 'advanced_page':
      unset($vars['content']['field_hide_title']);
      break;
  }
  // kpr($vars);
}
