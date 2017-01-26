<?php

/**
 * @file
 * Override of preprocess functions.
 */

function tb_university_preprocess_html(&$vars) {
  $node_id = drupal_lookup_path('source','404-page');
  if(!empty($node_id)) {
    $parts = explode("/", $node_id);
    $n_id = false;
    if(count($parts) > 1) {
      $n_id = $parts[1];
    }
    if(in_array("html__node__$n_id", $vars['theme_hook_suggestions'])) {
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

function tb_university_preprocess_node(&$vars) {
  // process theme style
  $skins = nucleus_get_predefined_param('skins', array('default' => t("Default skin")));
  foreach ($skins as $key => $val) {
    if ($vars['node_url'] == base_path() . 'skins/' . $key && (!isset($_COOKIE['nucleus_skin']) || $_COOKIE['nucleus_skin'] != $key)) {
      setcookie('nucleus_skin', $key, time() + 100000, base_path());
      header('Location: ' . $vars['node_url']);
    }
  }
  
  $day = date('d',$vars['created']);
  $month = t(date('F',$vars['created']));
  $year = date('Y',$vars['created']);
  $vars['created_date'] = $day.' '.$month.' '.$year; // format date
  
  $vars['page'] = ($vars['type'] == 'page') ? TRUE : FALSE; // display node title
  
  $vars['comments_count'] = false;
  if (isset($vars['content']['links']['comment'])) {
    if (isset($vars['content']['links']['comment']['#links']['comment-comments'])) {
      $vars['comments_count'] = $vars['content']['links']['comment'];
      foreach ($vars['comments_count']['#links'] as $key => $value) {
        if ($key != 'comment-comments') {
          unset($vars['comments_count']['#links'][$key]);
        }
      }
      unset($vars['content']['links']['comment']['#links']['comment-comments']);
    }
  }
  
  $vars['node_category'] = false;
  foreach($vars['content'] as $key => $category) {
    if(isset($category['#field_type']) && isset($category['#weight']) && $category['#field_type'] == 'taxonomy_term_reference' && $category['#field_name'] == 'field_category') {
      $vars['node_category'] = drupal_render($category);
      unset($vars['content'][$key]);
      break;
    }
  }
  
  $vars['first_image'] = false;
  foreach($vars['content'] as $key => $image) {
    if(isset($image['#field_type']) && isset($image['#weight']) && $image['#weight'] == -1 && $image['#field_type'] == 'image') {
      $vars['first_image'] = drupal_render($image);
      unset($vars['content'][$key]);
      break;
    }
  }

}

function tb_university_preprocess_page(&$vars) {
  if (isset($vars['node']) && !in_array($vars['node']->type, array('page', 'webform')) && !in_array('page__node__delete', $vars['theme_hook_suggestions'])) {
    $result = db_select('node_type', NULL, array('fetch' => PDO::FETCH_ASSOC))
    ->fields('node_type', array('name'))
    ->condition('type', $vars['node']->type)
    ->execute()->fetchField();
    $vars['title'] = t($result);
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
/**
 * Override of Search().
 */
function tb_university_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
    $form['search_block_form']['#title'] = t('Search'); // Change the text on the label element
    $form['search_block_form']['#title_display'] = 'invisible'; // Toggle label visibilty
    $form['search_block_form']['#size'] = 40;  // define size of the textfield
    $form['search_block_form']['#default_value'] = t('Search'); // Set a default value for the textfield

    // Add extra attributes to the text box
    $form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = '".t('Search')."';}";
    $form['search_block_form']['#attributes']['onfocus'] = "if (this.value == '".t('Search')."') {this.value = '';}";
  }
}


/**
 * Override of theme_breadcrumb().
 */
function tb_university_breadcrumb($breadcrumb) {
  if (theme_get_setting('breadcrumb_display')) {
    $breadcrumb = $breadcrumb['breadcrumb'];
    $home_class = 'crumb-home';
    if (!empty($breadcrumb)) {
      $heading = '<h2 class="element-invisible">' . t("You are here:") . '</h2>';
      $separator = " &#187; ";
      $output = '';
      foreach ($breadcrumb as $key => $val) {
        if ($key == 0) {
          $output .= '<li class="crumb ' . $home_class . '">' . $val . '</li>';
        }
        else {
          $output .= '<li class="crumb"><span>' . $separator . '</span>' . $val . '</li>';
        }
      }
      return $heading . '<ol id="crumbs">' . $output . '</ol>';
    }
  }
  return '';
}

function tb_university_confirm_form(&$vars) {
  $form = $vars['form'];
  if($form['#form_id'] == 'comment_confirm_delete') {
    $form['description']['#markup'] = t('Are you sure you want to delete the comment %title? ', array('%title' => $form['#comment']->subject)) . $form['description']['#markup'];
    return drupal_render_children($form);
  }
}
