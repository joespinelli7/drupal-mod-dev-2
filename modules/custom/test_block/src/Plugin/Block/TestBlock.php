<?php

namespace Drupal\test_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * This plugin splits the nickname's body into subgroups.
 *
 * @Block(
 *   id = "test_block",
 *   admin_label = @Translation("test block"),
 * )
 *
 */
class TestBlock extends BlockBase {
  public function build()
  {
    return [
      '#markup' => 'Test Block',
    ];
  }
}

// Remember:
// Have to flush cache everytime when using xdebug on a block.
