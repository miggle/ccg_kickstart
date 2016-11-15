<?php

/**
 * @file
 * Defines the CCG Kickstart Profile install screen by modifying the install form.
 */

use Drupal\ccg_kickstart\Form\DefaultContentForm;

/**
 * Implements hook_install_tasks().
 */
function ccg_kickstart_install_tasks(&$install_state) {
  // Manually attempt to re-import our search index settings after installation
  // to ensure all the fields get picked up correctly.
  if ($install_state['installation_finished']) {
    $ccg_content_index = 'search_api.index.ccg_content';
    $data = Symfony\Component\Yaml\Yaml::parse(drupal_get_path('profile', 'ccg_kickstart') . '/config/install/' . $ccg_content_index . '.yml');
    \Drupal::service('config.factory')->getEditable($ccg_content_index)->setData($data)->save();
  }
  return array(
    'ccg_kickstart_default_content' => array(
      'display_name' => t('Create default content'),
      'display' => TRUE,
      'type' => 'form',
      'function' => DefaultContentForm::class,
    ),
  );
}
