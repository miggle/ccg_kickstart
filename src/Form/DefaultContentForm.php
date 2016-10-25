<?php

namespace Drupal\ccg_kickstart\Form;

use Drupal\Core\Extension\ExtensionDiscovery;
use Drupal\Core\Extension\InfoParserInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;
use Drupal\Core\Render\Element\Checkboxes;
use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\lightning\Extender;
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
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $GLOBALS['install_state']['ccg_kickstart']['default_content'] = $form_state->getValue('default_content');
  }
}
