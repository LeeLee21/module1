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

    $form['#markup'] = '<p class="title">Hello! You can add here a photo of your cat.</p>';

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your cat’s name:'),
      '#description' => $this->t('min-2 symbols, max-32'),
      '#placeholder' => $this->t('min-2 symbols, max-32'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your email:'),
      '#required' => TRUE,
      '#description' => $this->t('Can only contain Latin letters, Hyphens, or Underscores.'),
      '#placeholder' => $this->t('Can only contain Latin letters, Hyphens, or Underscores.'),
      '#ajax' => [
        'callback' => '::validateEmailAjax',
        'event' => 'keyup',
      ],
    ];

    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add cat'),
      '#button_type' => 'primary',
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
      ],
    ];
    $form['message'] = [
      '#type' => 'markup',
      '#markup' => '<div class="message-status"></div>',
    ];
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state){
    $emailval = $form_state->getValue('email');
    if (strlen($form_state->getValue('name')) < 2) {
      $form_state->setErrorByName('name', $this->t('✗ Sorry =( Name is too short.'));
    }
    if (strlen($form_state->getValue('name')) > 32) {
      $form_state->setErrorByName('name', $this->t('✗ Sorry =( Name is too long'));
    }
    if (!preg_match('/^[A-Za-z1-9-_]+[@]+[a-z]+[.]+[a-z]+$/', $emailval)){
      $form_state ->setErrorByName('email', $this->t('✗ Email is not valid'));
    }
  }
  public function submitForm(array &$form, FormStateInterface $form_state) {}

  public function validateEmailAjax(array &$form, FormStateInterface $form_state ){
    $response = new AjaxResponse();
    $emailval = $form_state->getValue('email');
    if (!preg_match('/^[A-Za-z1-9-_]+[@]+[a-z]+[.]+[a-z]+$/', $emailval)){
      $response ->addCommand(new MessageCommand($this->t('✗ wrong email')));
    }
    else {
      $response->addCommand(new MessageCommand($this->t('✓ Your Email: ' . $form_state->getValue('email'))));
    }
    return $response;
  }

  public function ajaxSubmitCallback(array &$form, FormStateInterface $form_state) {
    $ajax_response = new AjaxResponse();
    if ($form_state->hasAnyErrors()){
      foreach ($form_state->getErrors() as $errorname)
      $ajax_response ->addCommand(new MessageCommand($errorname));
    \Drupal::messenger()->deleteAll();
    }
    else{
      $ajax_response ->addCommand(new MessageCommand($this->t('✓ Your added your cat =)')));
    }
    return $ajax_response;
  }
}
