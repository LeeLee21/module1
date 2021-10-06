<?php

namespace Drupal\leelee\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Url;

class deletecat extends ConfirmFormBase{

  public $catid;

  public function getFormId() {
    return 'Delete Cat';
  }

  public function getQuestion() {
    return t('Do you want to Delete KITTY?');
  }

  public function getCancelUrl() {
    return new Url('leelee.first_page');
  }

  public function getDescription() {
    return t('Do you want to delete ?');
  }

  public function getConfirmText() {
    return t('Delete');
  }

  public function getCancelText() {
    return t('Cancel');
  }

  public function buildForm(array $form, FormStateInterface $form_state, $catid = NULL){
    $this->id = $catid;
    return parent::buildForm($form, $form_state);
  }

  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    parent::validateForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state){
    $query = \Drupal::database();
    $query->delete('leelee')
      ->condition('id', $this->id)
      ->execute();
    \Drupal::messenger()->addStatus('U Deleted ur KITTY');
    $form_state->setRedirect('leelee.first_page');
  }
}
