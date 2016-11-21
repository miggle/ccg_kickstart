<?php

/**
 * @file
 * Defines the CCG Kickstart Profile install screen by modifying the install form.
 */

use Drupal\ccg_kickstart\Form\DefaultContentForm;
use Drupal\ccg_kickstart\Form\FeatureForm;

/**
 * Implements hook_install_tasks().
 */
function ccg_kickstart_install_tasks(&$install_state) {
  return array(
    'ccg_kickstart_features' => array(
      'display_name' => t('Select features'),
      'display' => TRUE,
      'type' => 'form',
      'function' => FeatureForm::class,
    ),
    'ccg_kickstart_default_content' => array(
      'display_name' => t('Create default content'),
      'display' => TRUE,
      'type' => 'form',
      'function' => DefaultContentForm::class,
    ),
  );
}
