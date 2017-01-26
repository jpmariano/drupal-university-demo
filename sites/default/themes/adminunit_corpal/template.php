<?php


/**
 * Implements hook_preprocess_html
 */
function adminunit_corpal_preprocess_html(&$vars){
 #krumo($vars);
  $node = menu_get_object(); 

if (isset( $node->type )){
	$nodetype = $node->type;

	 
	 switch ($nodetype) {
	 	
	    case 'basic':
			if (!empty($node->field_basic_bp_category_fk)) {
				foreach($node->field_basic_bp_category_fk as $topic_id => $topics) {
					  			foreach($topics as $topic) {
					  				$topics_array[] = $topic['entity']->title;
					  			} 
				  }
						
				  foreach($topics_array as $topic) {
					 $vars['classes_array'][] = drupal_html_class($topic);
				  }
			}
		  break; 
		  
	    case 'news': 
			if (!empty($node->field_news_topic_fk)) {
				foreach($node->field_news_topic_fk as $topic_id => $topics) {
				  			foreach($topics as $topic) {
				  				$topics_array[] = $topic['entity']->title;
				  			} 
				  }
						
				  foreach($topics_array as $topic) {
					 $vars['classes_array'][] = drupal_html_class($topic);
				  }
			}
	      break;
		  
	    case 'announcements':
			if (!empty($node->field_announcement_topics_fk)) {
				 foreach($node->field_announcement_topics_fk as $topic_id => $topics) {
				  			foreach($topics as $topic) {
				  				$topics_array[] = $topic['entity']->title;
				  			} 
				  }
						
				  foreach($topics_array as $topic) {
					 $vars['classes_array'][] = drupal_html_class($topic);
				  }
			}
			 break;
			 
	    case 'events':
			if (!empty($node->field_event_topic_fk)) {
				 foreach($node->field_event_topic_fk as $topic_id => $topics) {
				  			foreach($topics as $topic) {
				  				$topics_array[] = $topic['entity']->title;
				  			} 
				  }
						
				  foreach($topics_array as $topic) {
					 $vars['classes_array'][] = drupal_html_class($topic);
				  }
			}
		      break;
			  
	    case 'documents': 
	       if (!empty($node->field_doc_doc_types_fk)) {
			  foreach($node->field_doc_doc_types_fk as $topic_id => $topics) {
				  			foreach($topics as $topic) {
				  				$topics_array[] = $topic['entity']->title;
				  			} 
			  }
					
			  foreach($topics_array as $topic) {
				 $vars['classes_array'][] = drupal_html_class($topic);
			  }
		   }
		   
	      break;
		  
	    default:
	      break;
	  }

	}
}


/**
 * Implements hook_taxonomy_node_get_terms
 */

function adminunit_corpal_taxonomy_node_get_terms($node, $key = 'tid') {
  static $terms;
  if (!isset($terms[$node->vid][$key])) {
    $query = db_select('taxonomy_index', 'r');
    $t_alias = $query->join('taxonomy_term_data', 't', 'r.tid = t.tid');
    $v_alias = $query->join('taxonomy_vocabulary', 'v', 't.vid = v.vid');
    $query->fields( $t_alias );
    $query->condition("r.nid", $node->nid);
    $result = $query->execute();
    $terms[$node->vid][$key] = array();
    foreach ($result as $term) {
      $terms[$node->vid][$key][$term->$key] = $term;
    }
  }
  return $terms[$node->vid][$key];
}


/**
 * Override of hook_breadcrumb().
 */
function adminunit_corpal_breadcrumb($vars) {
  if (theme_get_setting('breadcrumb_display')) {
    $breadcrumb = $vars['breadcrumb'];
    $home_class = 'crumb-home';
    if (!empty($breadcrumb)) {
      $heading = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
      $separator = "/";
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



/**
* Implements hook_preprocess_field().
*/

function adminunit_corpal_preprocess_field(&$variables, $hook) {
	#krumo($variables);
	
	
   if (($variables['element']['#field_name'] == 'field_basic_sub_title' ) || 
   	   ($variables['element']['#field_name'] == 'field_news_sub_title') ||
   	   ($variables['element']['#field_name'] == 'field_sub_title') ||
   	   ($variables['element']['#field_name'] == 'field_event_sub_title') 
	  ){
   // do something
    $variables['items'][0]['#prefix'] = '<h3>';
    $variables['items'][0]['#suffix'] = '</h3>';
   }
	  
	  	
   if ( ($variables['element']['#field_name'] == 'field_news_author' ) ||
    	($variables['element']['#field_name'] == 'field_news_published_date' ) ||
    	($variables['element']['#field_name'] == 'field_news_more_info_url' ) 
   	  ) {
   // do something
    $variables['items'][0]['#prefix'] = '<p class="fs-smallest">';
    $variables['items'][0]['#suffix'] = '</p>';
   }
   
   
   if ( ($variables['element']['#field_name'] == 'field_news_media_title_position' ) ||
    	($variables['element']['#field_name'] == 'field_news_media_contact_email' ) ||
    	($variables['element']['#field_name'] == 'field_news_media_contact_phone' ) ||
    	($variables['element']['#field_name'] == 'field_event_contact_title_positi' ) ||
    	($variables['element']['#field_name'] == 'field_event_contact_email' ) ||
    	($variables['element']['#field_name'] == 'field_event_contact_phone' ) ||
    	($variables['element']['#field_name'] == 'field_announcement_contact_email' ) ||
    	($variables['element']['#field_name'] == 'field_announcement_contact_phone' ) ||
    	($variables['element']['#field_name'] == 'field_announcement_title_positio' ) 
   	  ) {
   // do something
    $variables['items'][0]['#prefix'] = '<span class="fs-smallest">';
    $variables['items'][0]['#suffix'] = '</span>';
   }
	  
 if ( ($variables['element']['#field_name'] == 'field_news_media_contact_name' ) ||
      ($variables['element']['#field_name'] == 'field_event_contact_name' ) ||
      ($variables['element']['#field_name'] == 'field_announcement_contact_name' ) 
   	  ) {
   // do something
    $variables['items'][0]['#prefix'] = '<span class="fs-smallest"><strong>';
    $variables['items'][0]['#suffix'] = '</strong></span>';
   }
   
   
   
}



/**
function adminunit_corpal_preprocess_node(&$variables, $hook) {
    $variables['text_size_region'] = t('Text Size Region');
}
*/

/**
* Implements hook_preprocess_node()
*/

function adminunit_corpal_preprocess_node(&$variables) {
	
	
  // define $node object, so it's be easier to use it
  $node = $variables['node'];
  $view_mode = $variables['view_mode']  ==  "teaser";

  // Get a list of all the regions for this theme

   if(($node) && ( !$view_mode)) { 
	  foreach (system_region_list($GLOBALS['theme']) as $region_key => $region_name) {
	
	    // Get the content for each region and add it to the $region variable
	    if ($blocks = block_get_blocks_by_region($region_key)) {
	      $variables['region'][$region_key] = $blocks;
	    }
	    else {
	      $variables['region'][$region_key] = array();
	    }
	  }
	
  }
 
  
  	  if(( $node->type =='news') && ( !$view_mode)) {
  
			  foreach($node->field_news_topic_fk as $topic_id => $topics) {
			  			foreach($topics as $topic) {
			  				$topics_array[] = $topic['entity']->title;
			  			} 
		    }
				if (in_array('Press Release', $topics_array)){
					$variables['press_release'] = "For Immediate Release";
				}
	 }
	  
	 if(  ($node->type =='events') && ( !$view_mode) ) {
		
		if( (!empty($variables['field_event_begin_date'][0]['value'])) && (empty($variables['field_event_end_date'][0]['value']))) {
			$datestamp = strtotime($variables['field_event_begin_date'][0]['value']);
			$date = date('F d, Y', $datestamp);
			$time = date('g:ia', $datestamp);
			$additional_field = "<span>$date | $time </span></br>";
				$variables['content']['my_additional_field'] = array(
			    '#markup' => $additional_field,
			    '#weight' => 3,
			);
    
        } 
		

		if( (!empty($variables['field_event_begin_date'][0]['value'])) && (!empty($variables['field_event_end_date'][0]['value']))) {
			
			$datestamp = strtotime($variables['field_event_begin_date'][0]['value']);
			$date = date('F d, Y', $datestamp);
			$time = date('g:ia', $datestamp);
			
			$end_datestamp = strtotime($variables['field_event_end_date'][0]['value']);
			$end_date = date('F d, Y', $end_datestamp);
			$end_time = date('g:ia', $end_datestamp);
			
			if ($date == $end_date ){
			  $additional_field = "<span class='fs-smallest'>$date | $time - $end_time </span></br>";
			} else {
              $additional_field = "<span class='fs-smallest'>Start: $date | $time </span></br><span class='fs-smallest' >End: $end_date | $end_time </span></br>";
            }
			
			$variables['content']['my_additional_field'] = array(
			    '#markup' => $additional_field,
			    '#weight' => 3,
			);
			
			
		}
		
		hide($variables['content']['field_event_begin_date']);
		hide($variables['content']['field_event_end_date']);

	 }
    
  
}


/**
 * Implements hook_preprocess_page()
 */
function adminunit_corpal_preprocess_page(&$vars) {
	
  if (isset($vars['node'])) {
    // If the node type is "blog" the template suggestion will be "page--blog.tpl.php".
    $vars['theme_hook_suggestions'][] = 'page__'. str_replace('_', '--', $vars['node']->type);
  }
  
}


/**
 * Theme function for ShareThis code based on settings.
 */
/**
function adminunit_corpal_sharethis($variables) {
  $data_options = $variables['data_options'];
  $m_path = $variables['m_path'];
  $m_title = $variables['m_title'];

  // Inject the extra services.
  foreach ($data_options['option_extras'] as $service) {
    $data_options['services'] .= ',"' . $service . '"';
  }

  // The share buttons are simply spans of the form class='st_SERVICE_BUTTONTYPE' -- "st" stands for ShareThis.
  $type = drupal_substr($data_options['buttons'], 4);
  $type = $type == "_" ? "" : check_plain($type);
  $service_array = explode(",", $data_options['services']);
  $st_spans = "";
  foreach ($service_array as $service_full) {
    // Strip the quotes from the element in the array (They are there for javascript)
    $service = explode(":", $service_full);

    // Service names are expected to be parsed by Name:machine_name. If only one
    // element in the array is given, it's an invalid service.
    if (count($service) < 2) {
      continue;
    }

    // Find the service code name.
    $serviceCodeName = drupal_substr($service[1], 0, -1);

    // Switch the title on a per-service basis if required.
    $title = $m_title;
    switch ($serviceCodeName) {
      case 'twitter':
        $title = empty($data_options['twitter_suffix']) ? $title : check_plain($title) . ' ' . check_plain($data_options['twitter_suffix']);
        break;
    }

    // Sanitize the service code for display.
    $display = check_plain($serviceCodeName);

    // Put together the span attributes.
    $attributes = array(
      'st_url' => $m_path,
      'st_title' => $title,
      'class' => 'st_' . $display . $type,
    );
    if ($serviceCodeName == 'twitter') {
      if (!empty($data_options['twitter_handle'])) {
        $attributes['st_via'] = $data_options['twitter_handle'];
        $attributes['st_username'] = $data_options['twitter_recommends'];
      }
    }
    // Only show the display text if the type is set.
    if (!empty($type)) {
      $attributes['displayText'] = check_plain($display);
    }
    // Render the span tag.
    $st_spans .= theme('html_tag', array(
      'element' => array(
        '#tag' => 'span',
        '#attributes' => $attributes,
        '#value' => '', // It's an empty span tag.
      ),
    ));
  }

    $rss = '<span st_url="http://adminunit-test24.dd:8083/content/abluo-huic-proprius" st_title="Abluo Huic Proprius" class="st_rss_large" displaytext="email" st_processed="yes">' . 
    		'<span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton">' . 
       			 '<span class="stLarge fa fa-rss fa-2x">' .  
       			   '</span>' .
           '</span>' .
      '</span>' ;
  
  
  
  // Output the embedded JavaScript.
  sharethis_include_js();


  return   '<div class="sharethis-wrapper">' . $st_spans . $rss .'</div>';
}

*/

