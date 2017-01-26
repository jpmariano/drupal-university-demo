<?php
/**
 * @file
 * features_administrative_content_types.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function features_administrative_content_types_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_image_default_styles().
 */
function features_administrative_content_types_image_default_styles() {
  $styles = array();

  // Exported image style: announcement_full_image__815x460_.
  $styles['announcement_full_image__815x460_'] = array(
    'label' => 'Announcement Full Image (815x460)',
    'effects' => array(
      22 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 815,
          'height' => 460,
        ),
        'weight' => 2,
      ),
    ),
  );

  // Exported image style: announcement_teaser__220x200_.
  $styles['announcement_teaser__220x200_'] = array(
    'label' => 'Announcement Teaser Image (220X200)',
    'effects' => array(
      14 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 220,
          'height' => 200,
        ),
        'weight' => 2,
      ),
    ),
  );

  // Exported image style: basic_full_image__815x460_.
  $styles['basic_full_image__815x460_'] = array(
    'label' => 'Basic Full Image (815x460)',
    'effects' => array(
      23 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 815,
          'height' => 460,
        ),
        'weight' => 2,
      ),
    ),
  );

  // Exported image style: basic_teaser__220x200_.
  $styles['basic_teaser__220x200_'] = array(
    'label' => 'Basic Teaser Image (220X200)',
    'effects' => array(
      15 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 220,
          'height' => 200,
        ),
        'weight' => 2,
      ),
    ),
  );

  // Exported image style: contact_profile_image__200x300_.
  $styles['contact_profile_image__200x300_'] = array(
    'label' => 'Contact Profile Image (200X300)',
    'effects' => array(
      16 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 200,
          'height' => 300,
        ),
        'weight' => 2,
      ),
    ),
  );

  // Exported image style: event_teaser_image__300x200_.
  $styles['event_teaser_image__300x200_'] = array(
    'label' => 'Event Teaser Image (300X200)',
    'effects' => array(
      17 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 300,
          'height' => 200,
        ),
        'weight' => 2,
      ),
    ),
  );

  // Exported image style: events_full_image__815x460_.
  $styles['events_full_image__815x460_'] = array(
    'label' => 'Events Full Image (815x460)',
    'effects' => array(
      24 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 815,
          'height' => 460,
        ),
        'weight' => 2,
      ),
    ),
  );

  // Exported image style: landing_full_image__1200x400_.
  $styles['landing_full_image__1200x400_'] = array(
    'label' => 'Landing Full Image (1200x400)',
    'effects' => array(
      25 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 1200,
          'height' => 400,
        ),
        'weight' => 2,
      ),
    ),
  );

  // Exported image style: news_full_image__815x460_.
  $styles['news_full_image__815x460_'] = array(
    'label' => 'News Full Image (815x460)',
    'effects' => array(
      26 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 815,
          'height' => 460,
        ),
        'weight' => 2,
      ),
    ),
  );

  // Exported image style: news_teaser_image__300x200_.
  $styles['news_teaser_image__300x200_'] = array(
    'label' => 'News Teaser Image (300X200)',
    'effects' => array(
      18 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 300,
          'height' => 200,
        ),
        'weight' => 2,
      ),
    ),
  );

  // Exported image style: slideshow_full_image__1200x600_.
  $styles['slideshow_full_image__1200x600_'] = array(
    'label' => 'Slideshow Full Image (1200X600)',
    'effects' => array(
      21 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 1200,
          'height' => 600,
        ),
        'weight' => 1,
      ),
    ),
  );

  // Exported image style: slideshow_teaser_image__220x200_.
  $styles['slideshow_teaser_image__220x200_'] = array(
    'label' => 'Slideshow Teaser Image (220X200)',
    'effects' => array(
      19 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 220,
          'height' => 200,
        ),
        'weight' => 2,
      ),
    ),
  );

  // Exported image style: slideshow_teaser_image__300x200_.
  $styles['slideshow_teaser_image__300x200_'] = array(
    'label' => 'Slideshow Teaser Image (300X200)',
    'effects' => array(
      20 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 300,
          'height' => 200,
        ),
        'weight' => 2,
      ),
    ),
  );

  return $styles;
}

/**
 * Implements hook_node_info().
 */
function features_administrative_content_types_node_info() {
  $items = array(
    'alerts' => array(
      'name' => t('Alerts'),
      'base' => 'node_content',
      'description' => t('Use this form to create and fill in the details for Alerts.'),
      'has_title' => '1',
      'title_label' => t('Alert Title'),
      'help' => '',
    ),
    'announcements' => array(
      'name' => t('Announcements'),
      'base' => 'node_content',
      'description' => t('Use this form to create and fill in the details for announcements.'),
      'has_title' => '1',
      'title_label' => t('Announcement Title'),
      'help' => '',
    ),
    'basic' => array(
      'name' => t('Basic'),
      'base' => 'node_content',
      'description' => t('For pages with basic information.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'basic_page_category' => array(
      'name' => t('Basic Page Category'),
      'base' => 'node_content',
      'description' => t('Use this form to create and fill in the details for basic page category.'),
      'has_title' => '1',
      'title_label' => t('Basic Page Category Title'),
      'help' => '',
    ),
    'contacts' => array(
      'name' => t('Contacts'),
      'base' => 'node_content',
      'description' => t('Use this form to create and fill in the details for contacts.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'document_types' => array(
      'name' => t('Document Types'),
      'base' => 'node_content',
      'description' => t('Use this form to create and fill in the details for Document Types. This is use for tagging Documents. '),
      'has_title' => '1',
      'title_label' => t('Document Types Category Title'),
      'help' => '',
    ),
    'documents' => array(
      'name' => t('Documents'),
      'base' => 'node_content',
      'description' => t('Use this form to create and fill in the details for documents.'),
      'has_title' => '1',
      'title_label' => t('Document Title'),
      'help' => '',
    ),
    'events' => array(
      'name' => t('Events'),
      'base' => 'node_content',
      'description' => t('Use this form to create and fill in the details for events.'),
      'has_title' => '1',
      'title_label' => t('Event Title'),
      'help' => '',
    ),
    'news' => array(
      'name' => t('News'),
      'base' => 'node_content',
      'description' => t('Use this form to create and fill in the details for news.'),
      'has_title' => '1',
      'title_label' => t('News Title'),
      'help' => '',
    ),
    'slideshow' => array(
      'name' => t('Slideshow'),
      'base' => 'node_content',
      'description' => t('Use this form to create and fill in the details for Slideshow.'),
      'has_title' => '1',
      'title_label' => t('Slideshow Title'),
      'help' => '',
    ),
    'slideshow_category' => array(
      'name' => t('Slideshow Category'),
      'base' => 'node_content',
      'description' => t('Use this form to create and fill in the details for Slideshow Category.'),
      'has_title' => '1',
      'title_label' => t('Slideshow Category Title'),
      'help' => '',
    ),
    'topics' => array(
      'name' => t('Topics'),
      'base' => 'node_content',
      'description' => t('Use this form to create and fill in the details for Topics. This is use for tagging events, announcements, and news. '),
      'has_title' => '1',
      'title_label' => t('Topics Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}

/**
 * Implements hook_weight_features_default_settings().
 */
function features_administrative_content_types_weight_features_default_settings() {
  $settings = array();

  $settings['alerts'] = array(
    'enabled' => 1,
    'range' => 100,
    'menu_weight' => 0,
    'default' => 0,
    'sync_translations' => 0,
  );

  $settings['announcements'] = array(
    'enabled' => 1,
    'range' => 100,
    'menu_weight' => 0,
    'default' => 0,
    'sync_translations' => 0,
  );

  $settings['basic'] = array(
    'enabled' => 1,
    'range' => 100,
    'menu_weight' => 0,
    'default' => 0,
    'sync_translations' => 0,
  );

  $settings['basic_page_category'] = array(
    'enabled' => 1,
    'range' => 50,
    'menu_weight' => 0,
    'default' => 0,
    'sync_translations' => 0,
  );

  $settings['contacts'] = array(
    'enabled' => 1,
    'range' => 100,
    'menu_weight' => 0,
    'default' => 0,
    'sync_translations' => 0,
  );

  $settings['document_types'] = array(
    'enabled' => 1,
    'range' => 50,
    'menu_weight' => 0,
    'default' => 0,
    'sync_translations' => 0,
  );

  $settings['documents'] = array(
    'enabled' => 1,
    'range' => 100,
    'menu_weight' => 0,
    'default' => 0,
    'sync_translations' => 0,
  );

  $settings['events'] = array(
    'enabled' => 1,
    'range' => 100,
    'menu_weight' => 0,
    'default' => 0,
    'sync_translations' => 0,
  );

  $settings['news'] = array(
    'enabled' => 1,
    'range' => 100,
    'menu_weight' => 0,
    'default' => 0,
    'sync_translations' => 0,
  );

  $settings['slideshow'] = array(
    'enabled' => 1,
    'range' => 100,
    'menu_weight' => 0,
    'default' => 0,
    'sync_translations' => 0,
  );

  $settings['slideshow_category'] = array(
    'enabled' => 1,
    'range' => 50,
    'menu_weight' => 0,
    'default' => 0,
    'sync_translations' => 0,
  );

  $settings['topics'] = array(
    'enabled' => 1,
    'range' => 50,
    'menu_weight' => 0,
    'default' => 0,
    'sync_translations' => 0,
  );

  return $settings;
}
