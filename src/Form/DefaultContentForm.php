<?php

namespace Drupal\ccg_kickstart\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines a form for determining whether default content should be created or not.
 */
class DefaultContentForm extends FormBase {

  /**
   * The Drupal application root.
   *
   * @var string
   */
  protected $root;

  /**
   * ExtensionSelectForm constructor.
   *
   * @param string $root
   *   The Drupal application root.
   */
  public function __construct($root) {
    $this->root = $root;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('app.root')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ccg_kickstart_default_content';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, array &$install_state = NULL) {
    $form['#title'] = $this->t('Create default content?');
    $form['default_content'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Check this box to create default content when installing the site.'),
    ];
    $form['actions'] = [
      'continue' => [
        '#type' => 'submit',
        '#value' => $this->t('Continue'),
      ],
      '#type' => 'actions',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    if ($form_state->getValue('default_content')) {
      // Simply install the default content module if default content has been selected.
      $installed = \Drupal::service('module_installer')->install(['ccg_default_content']);
      if ($installed) {
        drupal_set_message($this->t('Default content has been created.'), 'status');
      } else {
        drupal_set_message($this->t('Something went wrong with creating the default content.'), 'error');
      }
    }
  }
}
