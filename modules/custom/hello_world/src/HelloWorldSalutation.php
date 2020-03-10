<?php

namespace Drupal\hello_world;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Prepares the salutation to the world.
 */
class HelloWorldSalutation {

  use StringTranslationTrait;

  /**
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * HelloWorldSalutation constructor
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   * Can now use this variable to load our configuration object that we saved in the form.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * Returns the salutation
   */
  public function getSalutation() {
    $config = $this->configFactory->get('hello_world.custom_salutation');
    $salutation = $config->get('salutation');
    if ($salutation !== '') {
      return $salutation;
    }

    $time = new \Datetime();
    if ((int)$time->format('G') >= 00 && (int)$time->format('G') < 12) {
      return $this->t('Good morning world!');
    }

    if ((int)$time->format('G') >= 12 && (int)$time->format('G') < 18) {
      return $this->t('Good afternoon world!');
    }

    if ((int)$time->format('G') >= 18) {
      return $this->t('Good evening world!');
    }
  }
}
