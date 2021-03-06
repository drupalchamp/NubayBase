<?php

/**
 * @file
 * Template.php - process theme data for your sub-theme.
 * 
 * Rename each function and instance of "footheme" to match
 * your subthemes name, e.g. if you name your theme "footheme" then the function
 * name will be "footheme_preprocess_hook". Tip - you can search/replace
 * on "footheme".
 */


/**
 * Override or insert variables for the page templates.
 */
function nubay_preprocess_page(&$vars) {
  // load CiviCRM Extension style library on every civicrm page
  if (arg(0) == 'civicrm') {
    if (module_exists('style_library_entity')) {
      $civicrm_extension_enabled = theme_get_setting('nubay_civicrm_enable');
      if (!empty($civicrm_extension_enabled)) {
        $style_library_ids = theme_get_setting('nubay_civicrm_style_library');
        if (!empty($style_library_ids)) {
          try {
            foreach ($style_library_ids as $style_library_id) {
              $style_library = entity_load_single('style_library_entity', $style_library_id);
              style_library_entity_add_style_library_css_to_theme($style_library);
              style_library_entity_add_style_library_js_to_theme($style_library);
            }
          }
          catch (Exception $e) {
            watchdog('nubay_theme_extension', $e->getMessage());
          }
        }
      }
    }
  }
}

/**
 * Override or insert variables into the node templates.
 */
/* -- Delete this line if you want to use these functions
function nubay_preprocess_node(&$vars) {
}
function nubay_process_node(&$vars) {
}
*/


/**
 * Implements theme_preprocess_block().
 *
 * Add Superfish Menu Style Library CSS/JS to theme
 */
function nubay_preprocess_block(&$vars) {
  if (module_exists('style_library_entity')) {
    $superfish_extension_enabled = theme_get_setting('nubay_superfish_enable');
    if (!empty($superfish_extension_enabled)) {
      if (strpos($vars['block_html_id'], 'superfish') !== FALSE) {
        $style_library_ids = theme_get_setting('nubay_superfish_style_library');
        if (!empty($style_library_ids)) {
          try {
            foreach ($style_library_ids as $style_library_id) {
              $style_library = entity_load_single('style_library_entity', $style_library_id);
              style_library_entity_add_style_library_css_to_theme($style_library);
              style_library_entity_add_style_library_js_to_theme($style_library);
            }
          }
          catch (Exception $e) {
            watchdog('nubay_theme_extension', $e->getMessage());
          }
        }
      }
    }
  }
}

/**
 * Implements hook_form_alter().
 *
 * Add Webform Style Library CSS/JS to theme
 *
 * @param $form
 * @param $form_state
 * @param $form_id
 */
function nubay_form_alter(&$form, &$form_state, $form_id) {
  // add Webform style library css/js to theme
  if (strpos($form_id, 'webform_client_form') === 0) {
    if (module_exists('style_library_entity')) {
      $style_library_ids = theme_get_setting('nubay_webform_style_library');
      if (!empty($style_library_ids)) {
        try {
          foreach ($style_library_ids as $style_library_id) {
            $style_library = entity_load_single('style_library_entity', $style_library_id);
            style_library_entity_add_style_library_css_to_theme($style_library);
            style_library_entity_add_style_library_js_to_theme($style_library);
          }
        }
        catch (Exception $e) {
          watchdog('nubay_theme_extension', $e->getMessage());
        }
      }
    }
  }
}

/**
 * Implements theme_preprocess_html().
 *
 * @param $vars
 */
function nubay_preprocess_html(&$vars) {
  global $theme_key;
  $theme_name = $theme_key;
  if (at_get_setting('enable_extensions', $theme_name) == 1) {
    // Get the path to the directory where our CSS files are saved
    $path = variable_get('theme_' . $theme_name . '_files_directory');
    $file_paths = [];
    $file_paths[] = $path . '/' . $theme_name . '.themestyles.css';
    $file_paths[] = $path . '/' . $theme_name . '.inlineblock-styles.css';
    $file_paths[] = $path . '/' . $theme_name . '.blockmargins-styles.css';
    $file_paths[] = $path . '/' . $theme_name . '.inlineregions-styles.css';
    $file_paths[] = $path . '/' . $theme_name . '.superfish-styles.css';
    $file_paths[] = $path . '/' . $theme_name . '.webform-styles.css';
    $file_paths[] = $path . '/' . $theme_name . '.civicrm-styles.css';
    foreach ($file_paths as $file_path) {
      if (file_exists($file_path)) {
        drupal_add_css($file_path, array(
            'preprocess' => TRUE,
            'group' => CSS_THEME,
            'media' => 'screen',
            'every_page' => TRUE,
          )
        );
      }
    }
  }
}
