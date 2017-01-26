<?php
/**
 * @file
 * features_gallery_tb_corpal.features.inc
 */

/**
 * Implements hook_views_api().
 */
function features_gallery_tb_corpal_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_node_info().
 */
function features_gallery_tb_corpal_node_info() {
  $items = array(
    'tb_photo_gallery' => array(
      'name' => t('Gallery'),
      'base' => 'node_content',
      'description' => t('Photo Gallery'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
