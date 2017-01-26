<?php

/**
 * @file
 * Override of preprocess functions.
 */
function tb_corpal_preprocess_node(&$vars) {
  // process theme style
  $skins = nucleus_get_predefined_param('skins', array('default' => t("Default skin")));
  foreach ($skins as $key => $val) {
    if ($vars['node_url'] == base_path() . 'skins/' . $key && (!isset($_COOKIE['nucleus_skin']) || $_COOKIE['nucleus_skin'] != $key)) {
      setcookie('nucleus_skin', $key, time() + 100000, base_path());
      header('Location: ' . $vars['node_url']);
    }
  }
  
  $vars['created_day'] = date('d', $vars['created']);
  $vars['created_month'] = date('M', $vars['created']);
  $vars['created_year'] = date('Y', $vars['created']);
  
  if(isset($vars['content']['field_image'])){
    $vars['tb_corpal_first_image'] = drupal_render($vars['content']['field_image']);
    unset($vars['content']['field_image']);
  }
  if($vars['type'] == 'blog'){
    $vars['comments_count'] = false;
    if (isset($vars['content']['links']['comment'])) {
      if (isset($vars['content']['links']['comment']['#links']['comment-comments'])) {
        $vars['comments_count'] = $vars['content']['links']['comment'];
        foreach ($vars['comments_count']['#links'] as $key => $value) {
          if ($key != 'comment-comments') {
            unset($vars['comments_count']['#links'][$key]);
          }
        }
        $vars['comments_count']['#prefix'] = '<span class="comment-count-title">' . t('with') . '</span>';
        unset($vars['content']['links']['comment']['#links']['comment-comments']);
      }
    }
  }
  $vars['page'] = ($vars['type'] == 'page') ? TRUE : FALSE;
}

function tb_corpal_preprocess_page(&$vars) {
//  print($vars['show_messages']);
//s  exit;
  if (isset($vars['node'])) {
    if ($vars['node']->type != 'page') {
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
}

function tb_corpal_confirm_form(&$vars) {
  $form = $vars['form'];
  if($form['#form_id'] == 'comment_confirm_delete') {
    $form['description']['#markup'] = t('Are you sure you want to delete the comment %title? ', array('%title' => $form['#comment']->subject)) . $form['description']['#markup']; 
  	return drupal_render_children($form);
  }
}