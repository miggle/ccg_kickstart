<?php

namespace Drupal\ccg_kickstart_intranet\Plugin\Condition;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Condition\Annotation\Condition;
use Drupal\Core\Condition\ConditionPluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AccessDeniedCondition
 * @package Drupal\ccg_kickstart_intranet\Plugin\Condition
 *
 * @Condition(
 *   id = "ccg_access_denied",
 *   label = @Translation("Page access")
 * )
 */
class AccessDeniedCondition extends ConditionPluginBase {

  /**
   * {@inheritDoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);
    // Remove the negate option.
    unset($form['negate']);

    $form['status_codes'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Restrict to the following pages'),
      '#default_value' => $this->configuration['status_codes'],
      '#options' => $this->getStatusCodes(),
      '#description' => $this->t('Restrict the visibility'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'status_codes' => [],
    ] + parent::defaultConfiguration();
  }

  private function getStatusCodes() {
    return [
      '403' => $this->t('403 pages'),
      '404' => $this->t('404 pages'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $this->configuration['status_codes'] = $form_state->getValue('status_codes');
    parent::submitConfigurationForm($form, $form_state);
  }

  /**
   * Evaluates the condition and returns TRUE or FALSE accordingly.
   *
   * @return bool
   *   TRUE if the condition has been met, FALSE otherwise.
   */
  public function evaluate() {
    // Get the current page/internal route.
    $response_code = \Drupal::request()->query->get('_exception_statuscode');
    $restricted_to_status_codes = $this->configuration['status_codes'];

    // Empty for no restriction.
    if (empty(array_filter($restricted_to_status_codes))) {
      return TRUE;
    }
    // Check route against config.
    if (in_array((string)$response_code, $restricted_to_status_codes, TRUE)) {
      return TRUE;
    }

    return FALSE;
  }

  /**
   * Provides a human readable summary of the condition's configuration.
   */
  public function summary() {
    $status_codes = $this->configuration['status_codes'];

    if (!empty($status_codes)) {
      $summary = $this->t('Restricted to ') . implode(' & ', $status_codes) . $this->t(' pages');
    }
    else {
      $summary = $this->t('Not restricted');
    }

    return $summary;
  }
}
