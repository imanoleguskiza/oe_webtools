<?php

namespace Drupal\oe_piwik_rules\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class PiwikRuleEntityForm.
 */
class PiwikRuleEntityForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $piwik_rule = $this->entity;
    $form['section'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Section'),
      '#maxlength' => 255,
      '#default_value' => $piwik_rule->section(),
      '#description' => $this->t("The section activated by the rule."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $piwik_rule->id(),
      '#machine_name' => [
        'exists' => '\Drupal\oe_piwik_rules\Entity\PiwikRuleEntity::load',
        'source' => ['section'],
      ],
      '#disabled' => !$piwik_rule->isNew(),
    ];

    $form['regex'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Regex'),
      '#maxlength' => 255,
      '#default_value' => $piwik_rule->regex(),
      '#description' => $this->t("The section activated by the rule."),
      '#required' => TRUE,
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $piwik_rule = $this->entity;
    $status = $piwik_rule->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Piwik rule.', [
          '%label' => $piwik_rule->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Piwik rule.', [
          '%label' => $piwik_rule->label(),
        ]));
    }
    $form_state->setRedirectUrl($piwik_rule->toUrl('collection'));
  }

}
