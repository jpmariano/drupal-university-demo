<?php

function custom_form_form_1($form, &$form_state) {
  $form['#tree'] = TRUE;
	
	$form['name'] = array(
    '#type' => 'fieldset',
    '#title' => t('Name'),
  );
	
	$form['name']['firstname'] = array(
    '#type' => 'textfield',
    '#title' => t('First Name'),
  );
	
  $form['name']['lastname'] = array(
    '#type' => 'textfield',
    '#title' => t('Last Name'),
  );
	

  $form['home'] = array(
    '#type' => 'fieldset',
    '#title' => t('Home address'),
  );
  $form['home']['street'] = array(
    '#type' => 'textfield',
    '#title' => t('Street Address'),
  );
  $form['home']['city'] = array(
    '#type' => 'textfield',
    '#title' => t('City'),
  );
	 $form['home']['zipcode'] = array(
    '#type' => 'textfield',
    '#title' => t('Zipcode'),
    '#size' => 'small',
  );
	$form['email'] = array(
    '#type' => 'textfield',
    '#title' => t('Email'),
    '#size' => 'small',
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Submit'),
  );

  return $form;
}

function custom_form_form_1_submit(&$form, &$form_state) {
  dsm($form_state);
	$table = 'custom_form';
	$record = new stdClass();
	$record->first_name = $form_state['values']['name']['firstname'];
	$record->last_name = $form_state['values']['name']['lastname'];
	$record->street = $form_state['values']['home']['street'];
	$record->city = $form_state['values']['home']['city'];
	$record->zipcode = $form_state['values']['home']['zipcode'];
	$record->email = $form_state['values']['email'];
	drupal_write_record($table, $record);
	
	// The new bunny ID, $record->bid, was set by drupal_write_record()
	// since $record is passed by reference.
	watchdog('custom_form', 'Added custom_form with id %id.', array('%id' => $record->nid));
}
