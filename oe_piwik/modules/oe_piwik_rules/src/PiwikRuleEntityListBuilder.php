<?php

namespace Drupal\oe_piwik_rules;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of Piwik rule entities.
 */
class PiwikRuleEntityListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['section'] = $this->t('Section');
    $header['regex'] = $this->t('Regex');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['section'] = $entity->section();
    $row['id'] = $entity->regex();
    // You probably want a few more properties here...
    return $row + parent::buildRow($entity);
  }

}
