<?php

/**
 * @file
 * Defines the CCG Kickstart Profile install screen by modifying the install form.
 */

use Drupal\ccg_kickstart\Form\DefaultContentForm;

/**
 * Implements hook_install_tasks().
 */
function lightning_install_tasks() {
  return array(
    'ccg_kickstart_default_content' => array(
      'display_name' => t('Create default content?'),
      'display' => TRUE,
      'type' => 'form',
      'function' => DefaultContentForm::class,
    ),
    'ccg_kickstart_install_default_content' => array(
      'display_name' => t('Create default content'),
      'display' => TRUE,
      'type' => 'batch',
    ),
  );
}
