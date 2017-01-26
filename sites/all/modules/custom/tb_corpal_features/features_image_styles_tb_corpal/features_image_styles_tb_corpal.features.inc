<?php
/**
 * @file
 * features_image_styles_tb_corpal.features.inc
 */

/**
 * Implements hook_image_default_styles().
 */
function features_image_styles_tb_corpal_image_default_styles() {
  $styles = array();

  // Exported image style: blog.
  $styles['blog'] = array(
    'label' => 'blog',
    'effects' => array(
      8 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 580,
          'height' => 300,
        ),
        'weight' => 1,
      ),
    ),
  );

  // Exported image style: gallery.
  $styles['gallery'] = array(
    'label' => 'gallery',
    'effects' => array(
      4 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 90,
          'height' => 90,
        ),
        'weight' => 1,
      ),
    ),
  );

  // Exported image style: gallery_colorbox.
  $styles['gallery_colorbox'] = array(
    'label' => 'gallery_colorbox',
    'effects' => array(
      13 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 490,
          'height' => 300,
        ),
        'weight' => 1,
      ),
    ),
  );

  // Exported image style: our_business.
  $styles['our_business'] = array(
    'label' => 'our_business',
    'effects' => array(
      7 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 205,
          'height' => 150,
        ),
        'weight' => 1,
      ),
    ),
  );

  // Exported image style: our_clients.
  $styles['our_clients'] = array(
    'label' => 'our_clients',
    'effects' => array(
      5 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 125,
          'height' => 60,
        ),
        'weight' => 1,
      ),
    ),
  );

  // Exported image style: our_staffs.
  $styles['our_staffs'] = array(
    'label' => 'our_staffs',
    'effects' => array(
      6 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 70,
          'height' => 70,
        ),
        'weight' => 1,
      ),
    ),
  );

  // Exported image style: popular.
  $styles['popular'] = array(
    'label' => 'popular',
    'effects' => array(
      12 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 318,
          'height' => 150,
        ),
        'weight' => 1,
      ),
    ),
  );

  // Exported image style: quicktabs.
  $styles['quicktabs'] = array(
    'label' => 'quicktabs',
    'effects' => array(
      11 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 80,
          'height' => 80,
        ),
        'weight' => 1,
      ),
    ),
  );

  // Exported image style: slideshow.
  $styles['slideshow'] = array(
    'label' => 'slideshow',
    'effects' => array(
      1 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 1200,
          'height' => 600,
        ),
        'weight' => 1,
      ),
    ),
  );

  return $styles;
}
