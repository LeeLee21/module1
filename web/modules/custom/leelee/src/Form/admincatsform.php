<?php

namespace Drupal\leelee\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\file\Entity\File;

class admincatsform extends FormBase {

  public function getFormId() {
    return "leelee_admin";
  }

  public $catid;

  public function buildForm($form, $form_state, $catid = NULL) {
    $this->id = $catid;
    $query = \Drupal::database();
    $result = $query
      ->select('leelee', 'l')
      ->fields('l', ['name', 'email', 'image', 'timestamp', 'id'])
      ->orderBy('timestamp', 'DESC')
      ->execute()->fetchAll();

    $cats = [];

    foreach ($result as $cat) {
      $file = File::load($cat->image);
      $uri = $file->getFileUri();
      $pet_image = [
        '#theme' => 'image',
        '#uri' => $uri,
        '#alt' => 'Cat Image',
        '#title' => 'Your Cat',
        '#width' => 100,
        '#height' => 100,
      ];

      $url_delete = Url::fromRoute('leelee.AdminDeleteCat', ['catid' => $cat->id]);
      $url_edit = Url::fromRoute('leelee.AdminEditCat', ['catid' => $cat->id]);
      $delete_link = [
        '#title' => 'Delete',
        '#type' => 'link',
        '#url' => $url_delete,
        '#attributes' => [
          'class' => ['use-ajax'],
          'data-dialog-type' => 'modal',
        ],
        '#attached' => [
          'library' => ['core/drupal.dialog.ajax'],
        ],
      ];
      $edit_link = [
        '#title' => 'Edit',
        '#type' => 'link',
        '#url' => $url_edit,
        '#attributes' => [
          'class' => ['use-ajax'],
          'data-dialog-type' => 'modal',
        ],
        '#attached' => [
          'library' => ['core/drupal.dialog.ajax'],
        ],
      ];

      $cats[$cat->id] = [
        ['data' => $pet_image],
        $cat->id,
        $cat->name,
        $cat->email,
        $cat->timestamp,
        [
          'data' => $delete_link,
        ],
        [
          'data' => $edit_link,
        ],
      ];
    }
    $header = ['Image', 'id', 'Name', 'Email', 'Timestamp', 'Delete', 'Edit'];
    $form['table'] = [
      '#type' => 'tableselect',
      '#header' => $header,
      '#options' => $cats,
      '#empty' => $this->t('Nothing'),
    ];
    $form['delete cats'] = [
      '#type' => 'submit',
      '#value' => $this->t('Delete'),
      '#button_type' => 'submit',
      '#attributes' => ['onclick' => 'if(!confirm("Do you want to delete this record?")){return false;}'],
    ];
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValue('table');
    $delete = array_filter($values);
    if (empty($delete)) {
      $this->messenger()->addError($this->t("U Need To Choose Something"));
    } else {
      $query = \Drupal::database()->delete('leelee')
        ->condition('id', $delete, 'IN')
        ->execute();
      $this->messenger()->addStatus($this->t("Deleted"));
    }
  }
}
