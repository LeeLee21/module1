<?php
/**
 * @file
 * Contains \Drupal\rgb\Form\catForm.
 *
 */

namespace Drupal\rgb\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


class CatForm extends FormBase
{

    public function getFormId()
    {
        return 'cat_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $form['name'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Your cat’s name:'),
          '#placeholder' => $this->t('Your name have to contain from 2 to 32 symbols'),
          '#required' => true,
        ];

        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = [
          '#type' => 'submit',
          '#value' => $this->t('Add cat'),
          '#button_type' => 'primary',
        ];
        return $form;
    }
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        if (strlen($form_state->getValue('name')) < 2) {
            $form_state->setErrorByName('name', $this->t('Name is too short.'));
        } elseif (strlen($form_state->getValue('name')) >32) {
            $form_state->setErrorByName('name', $this->t('Name is too long.'));
        }
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        \Drupal::messenger()->addMessage("You adedd a cat!");
    }
}
