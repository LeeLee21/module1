<?php
/**
 * @return
 * Contains \Drupal\drupalbook\Controller\FirstPageController.
 */

namespace Drupal\leelee\Controller;

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
      '#theme' => 'cat-theme',
    );
    return $element;
  }

}
