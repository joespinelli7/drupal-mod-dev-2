<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for the salutation message.
 */
class HelloWorldController extends ControllerBase {

  /**
   * Hello World.
   *
   * returns @array
   */
  public function helloWorld() {
    return [
      '#markup' => $this->t('Hello World:)')
    ];
  }
}
