<?php

/**
 * Loads UI controller and generates view pages for Style Library Entities
 *
 * Callback for hook_menu().
 *
 * @param integer $id
 *
 * @return array $content
 *
 * @ingroup callbacks
 */
function style_library_entity_package_view($id) {
  $content = "";
  if(is_object($id)) {
    $entity = $id;
    $id = $entity->slid;
  }
  else {  
    $entity = entity_load_single('style_library_entity', $id);
  }
  if (!empty($entity)) {
    $controller = entity_get_controller('style_library_entity');
    $content = $controller->view(array($id => $entity));
    drupal_set_title('Style Library Entity ID: ' . $entity->label());

  }
  else {
    drupal_set_title('Style Library Entity Not Found.');
    $content = '<p>No Style Library Entity found for drupal id: ' . $id . '</p>';
  }
  return $content;
}



function style_library_entity_form_wrapper($entity_id, $op) {
  return drupal_get_form('style_library_entity_form', $entity_id, $op);
}

function style_library_entity_form($form, &$form_state, $entity_id, $op) {
  if ($op == 'update' ) {
    $entity = entity_load('style_library_entity', array($entity_id));
    $entity = $entity[$entity_id];
    $form_state['entity'] = $entity;
  }
  elseif ($op == 'delete') {
    $entity = $entity_id;
    $form_state['entity'] = $entity;
  }
  elseif ($op == 'create') {
    $entity = new StyleLibraryEntity(array());
    $entity->is_new = TRUE;
    $form_state['entity'] = $entity;
  }
  // Add the field related form elements.
  if (!empty($entity) && ($op == 'update' || $op == 'create')) {
    if($op == 'update') {
      $title = 'Edit Style Library ' . $entity->name ;
    }
    else {
      $title = 'Add Style Library Entity';
    }
    field_attach_form('style_library_entity', $entity, $form, $form_state);
    //get entity controller build content
    if ($op == 'update' || $op == 'delete') {
      $wrapper = entity_metadata_wrapper('style_library_entity', $entity);
    }
    else {
      $wrapper = entity_metadata_wrapper('style_library_entity');
    }
    
    $form_state['entity_wrapper'] = $wrapper;

    foreach ($wrapper as $name => $child) {
      $info = $child->info();
      if (strpos($info['name'], 'field_') === 0) {
        continue;
      }
      if(isset($info['widget'])) {
        $form[$name] = array(
          '#type' => $info['widget'],
          '#title' => $info['label'],
          '#description' => !empty($info['description']) ? $info['description'] : '',
          '#default_value' => $op == 'update' ? $child->value() : '',
          );
        if(isset($info['required']) && $info['required']){
          $form[$name]['#required'] = TRUE;
        }
        if ($name == 'extension_type') {
          $form[$name]['#type'] = 'select';
          $form[$name]['#options'] = [
            'superfish' => 'Superfish',
          ];
          unset($form[$name]['#size']);
        }
      } // end if isset widget
    } // end foreach child

    $form['actions'] = array(
      '#type' => 'container',
      '#attributes' => array('class' => array('form-actions')),
      '#weight' => 400,
    );

    $form['#validate'] = array();
    $form['#submit'] = array();
    $form['#validate'][] = 'style_library_entity_form_validate';
    $form['#submit'][] = 'style_library_entity_form_submit';
    // We add the form's #submit array to this button along with the actual submit
    // handler to preserve any submit handlers added by a form callback_wrapper.
    $submit = array();

    if (!empty($form['#submit'])) {
      $submit += $form['#submit'];
    }

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Save'),
      '#submit' => $submit + array(),
    );
    
    if(isset($form['redirect'])) {
      $form['redirect']['#weight'] = 200;
    }
    

  } //end if op is add or edit
  
  if($op == 'delete') {

    $form['delete_markup'] = array(
      '#type' => 'markup',
      '#markup' => '<div></strong>' . t('Are you sure you want to delete ') . 'Style Library: ' . $entity->name . '</strong></div>',
    );

    $form['actions'] = array(
      '#type' => 'container',
      '#attributes' => array('class' => array('form-actions')),
      '#weight' => 400,
    );

    $form['#validate'] = array();
    $form['#submit'] = array();
    $form['#validate'][] = 'style_library_entity_delete_form_validate';
    $form['#submit'][] = 'style_library_entity_delete_form_submit';
    // We add the form's #submit array to this button along with the actual submit
    // handler to preserve any submit handlers added by a form callback_wrapper.

    $form['actions']['cancel'] = array(
      '#type' => 'submit',
      '#value' => t('Cancel'),
      '#submit' => array('style_library_entity_delete_form_cancel_submit'),
    );

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Delete'),
      '#submit' => $form['#submit'],
    );

    $title = 'Delete Style Library: ' . $entity->name;

  }

  drupal_set_title($title);
  
  return $form;
}

function style_library_entity_form_validate($form, &$form_state) {
  $entity = $form_state['entity'];
  foreach ($form_state['values'] as $key => $value) {
    $entity->{$key} = $value;
  }
  field_attach_form_validate('style_library_entity', $entity, $form, $form_state);
}

function style_library_entity_form_submit($form, &$form_state) {
  $entity = $form_state['entity'];
  foreach ($form_state['values'] as $key => $value) {
    $entity->{$key} = $value;
  }
  field_attach_submit('style_library_entity', $entity, $form, $form_state);
  $entity_wrapper = entity_metadata_wrapper('style_library_entity', $entity);
  $entity_wrapper->save();

  $destination = drupal_get_destination();
  $request_path = request_path();
  if(isset($destination['destination']) && $destination['destination'] != '' && $destination['destination'] != $request_path ) {
    $form_state['redirect'] = $destination['destination'];
  }
  else {
    $form_state['redirect'] = 'admin/appearance/style-library-entity/style-library/' . $entity->slid;
  }
  
  
  drupal_set_message(t('Style Library Entity save successful'));
  drupal_redirect_form($form_state);
}

/**
 * Form API validate callback for the entity delete form
 */
function style_library_entity_delete_form_validate(&$form, &$form_state) {

}

/**
 * Form API submit callback for the entity delete form.
 *
 */
function style_library_entity_delete_form_submit(&$form, &$form_state) {
  $entity = $form_state['entity'];

  $wrapper = entity_metadata_wrapper('style_library_entity', $entity);
  $wrapper->delete();
  
  $destination = drupal_get_destination();
  $request_path = request_path();
  if(isset($destination['destination']) && $destination['destination'] != '' && $destination['destination'] != $request_path ) {
    $form_state['redirect'] = $destination['destination'];
  }
  else {
    $form_state['redirect'] = 'admin/appearance/style-library-entity/style-libraries';
  }
  
  drupal_redirect_form($form_state);
}

/**
 * Form API submit callback for the entity delete form cancel button.
 *
 */
function style_library_entity_delete_form_cancel_submit(&$form, &$form_state) {
  $entity = $form_state['entity'];

  $destination = drupal_get_destination();
  $request_path = request_path();
  if(isset($destination['destination']) && $destination['destination'] != '' && $destination['destination'] != $request_path ) {
    $form_state['redirect'] = $destination['destination'];
  }
  else {
    $form_state['redirect'] = 'admin/appearance/style-library-entity/style-library/' . $entity->slid;
  }
  drupal_redirect_form($form_state);
}

