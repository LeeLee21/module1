<?php

namespace Drupal\test_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for test_module routes.
 */
class TestModuleController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('hello'),
    ];

    return $build;
  }

}
