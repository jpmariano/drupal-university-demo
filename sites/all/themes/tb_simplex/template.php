<?php

/**
 * @file
 * Override of preprocess functions.
 */
function tb_simplex_preprocess_html(&$vars) {
  $node_id = drupal_lookup_path('source', '404-page');
  if (!empty($node_id)) {
    $parts = explode("/", $node_id);
    $n_id = false;
    if (count($parts) > 1) {
      $n_id = $parts[1];
    }
    if (in_array("html__node__$n_id", $vars['theme_hook_suggestions'])) {
      $vars['theme_hook_suggestions'][] = 'html__404';
    }
  }
  if (count($vars['theme_hook_suggestions']) == 1) {
    if (isset($vars['page']['content']['system_main']['main']['#markup']) &&
      trim($vars['page']['content']['system_main']['main']['#markup']) == t('The requested page "@path" could not be found.', array('@path' => request_uri()))) {
      $vars['theme_hook_suggestions'][] = 'html__404';
    }
  }
}

//function tb_simplex_form_alter(&$form, &$form_state, $form_id) {
//  if ($form_id == 'search_block_form') {
//    $form['search_block_form']['#title'] = t('Search'); // Change the text on the label element
//    $form['search_block_form']['#title_display'] = 'invisible'; // Toggle label visibilty
//    $form['search_block_form']['#size'] = 40;  // define size of the textfield
//    $form['search_block_form']['#default_value'] = t('Search'); // Set a default value for the textfield
//
//    // Add extra attributes to the text box
//    $form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = '".t('Search')."';}";
//    $form['search_block_form']['#attributes']['onfocus'] = "if (this.value == '".t('Search')."') {this.value = '';}";
//  }
//}

function tb_simplex_preprocess_page(&$vars) {
  if (isset($vars['node'])) {
    if ($vars['node']->type != 'page' && $vars['node']->type!='webform') {
      $vars['title'] = "";
      $result = db_select('node_type', NULL, array('fetch' => PDO::FETCH_ASSOC))
        ->fields('node_type', array('name'))
        ->condition('type', $vars['node']->type)
        ->execute();
      foreach ($result as $item) {
        $vars['title'] = $item['name'];
      }
    }
  }
  if ($vars['theme_hook_suggestions'][0] == 'page__comment') {
    if (in_array('page__comment__delete', $vars['theme_hook_suggestions'])) {
      $vars['title'] = t("Delete comment");
    }
    elseif (in_array('page__comment__edit', $vars['theme_hook_suggestions'])) {
      $vars['title'] = t('Edit comment');
    }
  }
  $domain = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];  
  drupal_add_js('jQuery.extend(Drupal.settings, { "pathToTheme": "' . path_to_theme() . '" });', 'inline');  
  drupal_add_js('jQuery.extend(Drupal.settings, { "tb_simplex_domain": "' . $domain . '" });', 'inline');  
}

function tb_simplex_preprocess_node(&$vars) {
  $vars['page'] = ($vars['type'] == 'page' || $vars['type'] == 'webform') ? TRUE : FALSE;

  // Category
  if (!empty($vars['content']['field_blog_category'])) {
    $vars['category_blog'] = $vars['content']['field_blog_category'];
    $vars['content']['field_blog_category'] = NULL;
  }
  // Quote
  if (!empty($vars['content']['field_blog_quote'])) {
    $vars['blog_quote'] = $vars['content']['field_blog_quote'];
    $vars['quote_link'] = $vars['content']['field_quote_link'];
    $vars['quote_author'] = $vars['content']['field_quote_author'];
    $vars['content']['field_blog_quote'] = NULL;
    $vars['content']['field_quote_link'] = NULL;
    $vars['content']['field_quote_author'] = NULL;
  }
  // Comments     
  if(isset($vars['content']['links']['comment'])) {
      //Teaser mode    
    if(isset($vars['content']['links']['comment']['#links']['comment-comments'])) {
        $vars['is_teaser'] = TRUE;
      $vars['comments_count'] = $vars['content']['links']['comment'];
      foreach($vars['comments_count']['#links'] as $key => $value) {
        if ($key != 'comment-comments') {
          unset($vars['comments_count']['#links'][$key]);
        }
      }
      $c = (int)$vars['comments_count']['#links']['comment-comments']['attributes']['content'];
      $ct = $c > 1?'Comments ':'Comment ';      
      $vars['comments_count']['#prefix'] = '<strong class="comment-count-title">' . t("$ct"). ': </strong>';
      unset($vars['content']['links']['comment']['#links']['comment-comments']);      
      $vars['comments_count']['#links']['comment-comments']['title'] = $c;
    } else {
        $vars['is_teaser'] = FALSE;
    }
  } else {
      $vars['is_teaser'] = FALSE;
  }

  foreach($vars['content'] as $key => $image) {
    if(isset($image['#field_type']) && isset($image['#weight']) && $image['#field_type'] == 'image' && $image['#weight'] == -1) {
      $vars['tb_first_image'] = drupal_render($image);
      unset($vars['content'][$key]);
      break;
    }
  }
}

