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
      '#theme' => 'cat-theme',
      '#form' => $form,
      '#table' => $this->getCatslist(),
    ];
  }

  public function getCatslist(){
    $query = \Drupal::database()->select('leelee', 'l')
      ->fields('l',['name', 'email', 'image', 'timestamp'])
      ->orderBy('timestamp', 'DESC')
      ->execute()->fetchAll();
    $data = [];

    foreach($query as $row) {
      $file = File::load($row->image);
      $uri = $file->getFileUri();
      $pet_image = [
        '#theme' => 'image',
        '#uri' => $uri,
        '#title' => 'Your Cat',
        '#width' => 150,
      ];
      $data [] = [
        'name' => $row->name,
        'email' => $row->email,
        'timestamp' => $row->timestamp,
        'image' => [
          'data' => $pet_image,
        ],
      ];
    }

    $build['table'] = [
      '#type' => 'table',
      '#rows' => $data,
    ];
    return $build;
  }

}
