<?php

namespace Drupal\redirect_from_identifier\Plugin\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Admin settings form.
 */
class RedirectFromIdentifierSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'redirect_from_identifier_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'redirect_from_identifier.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('redirect_from_identifier.settings');
    $form['redirect_from_identifier_target_fields'] = [
      '#type' => 'textfield',
      '#maxlength' => 256,
      '#title' => $this->t('Identifer fields'),
      '#default_value' => $config->get('redirect_from_identifier_target_fields'),
      '#description' => $this->t('A comma-separated list of machine names of node fields that store identifiers.'),
    ];
    $form['redirect_from_identifier_multiple_node_message'] = [
      '#type' => 'textfield',
      '#maxlength' => 256,
      '#title' => $this->t('Multiple node message'),
      '#default_value' => $config->get('redirect_from_identifier_multiple_node_message'),
      '#description' => $this->t('A message to show users when the identifier resolves to multiple nodes.'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->configFactory->getEditable('redirect_from_identifier.settings')
      ->set('redirect_from_identifier_target_fields', $form_state->getValue('redirect_from_identifier_target_fields'))
      ->set('redirect_from_identifier_multiple_node_message', $form_state->getValue('redirect_from_identifier_multiple_node_message'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
