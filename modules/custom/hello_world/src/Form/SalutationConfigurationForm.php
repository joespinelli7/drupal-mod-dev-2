<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form definition for the salutation message.
 */
class SalutationConfigurationForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   *
   * Used to specify that we are loading configuration objects for editing as oppposed to reading (immmutable)
   */
  protected function getEditableConfigNames() {
    return ['hello_world.custom_salutation'];
  }

  /**
   * {@inheritdoc}
   *
   * Returns a unique machine readable name for this form
   */
  public function getFormId() {
    return 'salutation_configuration_form';
  }

  /**
   * {@inheritdoc}
   *
   * Returns the form definition (form elements and definitions)
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('hello_world.custom_salutation');

    $form['salutation'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Salutation'),
      '#description' => $this->t('Please provide the salutation you want to use.'),
      '#default_value' => $config->get('salutation'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   *
   * Handler that gets called upon form submission (if passed validateForm() w/o errors).
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('hello_world.custom_salutation')
      ->set('salutatiom', $form_state->getValue('salutation'))
      ->save();

    parent::submitForm($form, $form_state);
  }

  /**
   * You can render forms programmatically (outside of specifying a route) by using the FormBuilder service.
   * Can be injected using the form_builder service key and build like so:
   * $form = $builder->getForm('Drupal\hello_world\Form\SalutationConfigForm');
   * Must request the form using the fully qualified name of the form class as shown above.
   */
}
