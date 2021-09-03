<?php
/**
 * @return
 * Contains \Drupal\drupalbook\Controller\FirstPageController.
 */

namespace Drupal\LeeLee\Controller;

/**
 * Provides route responses for the DrupalBook module.
 */
class CatsController {

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function content() {
    $element = array(
      '#markup' => 'Hello! You can add here a photo of your cat.',
    );
    return $element;
  }

}
