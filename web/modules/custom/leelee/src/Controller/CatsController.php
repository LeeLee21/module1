<?php
/**
 * @return
 * Contains \Drupal\drupalbook\Controller\FirstPageController.
 */

namespace Drupal\leelee\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\file\Entity\File;

/**
 * Provides route responses for the DrupalBook module.
 */
class CatsController extends ControllerBase{

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function content() {
    $form = \Drupal::formBuilder()->getForm('\Drupal\leelee\Form\catsform');
    return [
      '#theme' => 'cat-list',
      '#form' => $form,
      '#table' => $this->getCatslist(),
    ];
  }

  public function getCatslist(){
    $query = \Drupal::database()
      ->select('leelee', 'l')
      ->fields('l',['name', 'email', 'image', 'timestamp', 'id'])
      ->orderBy('timestamp', 'DESC')
      ->execute()->fetchAll();

    $cats = [];

    foreach($query as $cat) {
      $file = File::load($cat->image);
      $uri = $file->getFileUri();
      $pet_image = [
        '#theme' => 'image',
        '#uri' => $uri,
        '#title' => 'Your Cat',
        '#width' => 170,
        '#height' => 170,
      ];
      $cats [] = [
        '#theme' => 'cat',
        '#name' => $cat->name,
        '#email' => $cat->email,
        '#timestamp' => $cat->timestamp,
        '#image' => $pet_image,
        '#id' => $cat->id,
      ];
    }
    return $cats;
  }

}
