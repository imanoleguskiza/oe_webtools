<?php

namespace Drupal\oe_piwik_rules\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining Piwik rule entities.
 */
interface PiwikRuleEntityInterface extends ConfigEntityInterface {

  public function section();

  public function regex();
}
