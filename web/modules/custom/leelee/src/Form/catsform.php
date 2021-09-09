<?php
/**
 * @file
 * Contains \Drupal\leelee\Form\catsform.
 */
namespace Drupal\leelee\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\MessageCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class catsform extends FormBase {
  public function getFormId() {
    return 'catsform';
  }

  public function buildForm(array $form, FormStateInterface $form_state){
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your cat’s name:'),
      '#placeholder' => $this->t('min-2 symbols, max-32'),
      '#required' => TRUE,
    ];

    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add cat'),
      '#button_type' => 'primary',
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'progress' => [
          'type' => 'throbber',
        ],
      ],
    ];
    return $form;
  }

  public function ajaxSubmitCallback(array &$form, FormStateInterface $formState) {
    if (!$formState->hasAnyErrors()){
      $ajax_response = new AjaxResponse();
      $ajax_response ->addCommand(new MessageCommand($this->t('Your cat name is @cat_name =)', ['@cat_name' => $formState->getValue('name')])));
    \Drupal::messenger()->deleteAll();
      return $ajax_response;
    }
  }

  public function validateForm(array &$form, FormStateInterface $form_state){
    if (strlen($form_state->getValue('name')) < 2) {
      $form_state->setErrorByName('name', $this->t('Sorry =( Name is too short.'));
    }
    if (strlen($form_state->getValue('name')) > 32) {
      $form_state->setErrorByName('name', $this->t('Sorry =( Name is too long'));
    }

  }
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addStatus($this->t('Your cat name is @cat_name', ['@cat_name' => $form_state->getValue('name')]));
  }
}
