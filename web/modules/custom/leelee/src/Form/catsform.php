<?php
/**
 * @file
 * Contains \Drupal\leelee\Form\catsform.
 */
namespace Drupal\leelee\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class catsform extends FormBase {
  public function getFormId() {
    return 'collect_phone';
  }

  public function buildForm(array $form, FormStateInterface $form_state){
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Your cat’s name:'),
      '#placeholder' => $this->t('min-2 symbols, max-32'),
      '#required' => TRUE,
    );

    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Add cat'),
      '#button_type' => 'primary',
    );
    return $form;
  }
  public function validateForm(array &$form, FormStateInterface $form_state){
    if (strlen($form_state->getValue('name')) < 2) {
      $form_state->setErrorByName('name', $this->t('Name is too short.'));
    }
    if (strlen($form_state->getValue('name')) > 32) {
      $form_state->setErrorByName('name', $this->t('Name is too long.'));
    }

  }
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addStatus($this->t('YAY!!! You added your cat =)☺'));
    $form_state->setRedirect('<front>');
  }
}
