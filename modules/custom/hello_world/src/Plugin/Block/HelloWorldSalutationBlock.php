<?php

namespace Drupal\hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\hello_world\HelloWorldSalutation as HelloWorldSalutation;

/**
 * Hello World Salutation block. This annotation (@)Block denotes that this class is a Block plugin
 *
 * @Block (
 *  id = "hello_world_salutation_block",
 *  admin_label = @Translation("Hello world salutation"),
 * )
 *
 * extending BlockBase provides helpful things for Block plugin and is needed.
 * ContainerFactoryPluginInterface is optional but makes this plugin container-aware, at its moment of instantiation
 * it uses the create() method to build itself using the container for dependencies.
 */
class HelloWorldSalutationBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The salutation service
   *
   * @var HelloWorldSalutation
   */
  protected $salutation;

  /**
   * Construct
   *
   * @param array $configuration
   *  A configuration array containing info about the plugin instance.
   * @param $plugin_id
   *  The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *  The plugin implementation definition.
   * @param HelloWorldSalutation $salutation
   *  The salutation service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, HelloWorldSalutation $salutation) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->salutation = $salutation;
  }

  /**
   * {@inheritdoc}
   *
   * Where you can choose service(s) you want.
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('hello_world.salutation')
    );
  }

  /**
 * {@inheritdoc}
 *
 */
  public function defaultConfiguration() {
    return [
      'enabled' => 1,
    ];
  }

  /**
   * {@inheritdoc}
   *
   */
  public function blockForm($form, FormStateInterface $form_state) {
//    getConfiguration() coming from parent class to load up the configuration values that get saved with this block.
    $config = $this->getConfiguration();

    $form['enabled'] = [
      '#type' => 'checkbox',
      '#title' => t('Enabled'),
      '#description' => t('Check this box if you want to enable this feature.'),
      '#default_value' => $config['enabled'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   *
   * mapping the value submitted in the form to the relevant key in the configuration
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['enabled'] = $form_state->getValue('enabled');
  }

  /**
   * {@inheritdoc}
   *
   */
  public function build() {
    return [
      '#markup' => $this->salutation->getSalutation(),
    ];
  }
}
