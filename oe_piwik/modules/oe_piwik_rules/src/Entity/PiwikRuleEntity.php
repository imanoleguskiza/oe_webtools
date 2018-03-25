<?php

namespace Drupal\oe_piwik_rules\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Piwik rule entity.
 *
 * @ConfigEntityType(
 *   id = "piwik_rule",
 *   label = @Translation("Piwik site section rule"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\oe_piwik_rules\PiwikRuleEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\oe_piwik_rules\Form\PiwikRuleEntityForm",
 *       "edit" = "Drupal\oe_piwik_rules\Form\PiwikRuleEntityForm",
 *       "delete" = "Drupal\oe_piwik_rules\Form\PiwikRuleEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\oe_piwik_rules\PiwikRuleEntityHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "piwik_rule",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "section" = "section",
 *     "regex" = "regex",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/piwik_rule/{piwik_rule}",
 *     "add-form" = "/admin/structure/piwik_rule/add",
 *     "edit-form" = "/admin/structure/piwik_rule/{piwik_rule}/edit",
 *     "delete-form" = "/admin/structure/piwik_rule/{piwik_rule}/delete",
 *     "collection" = "/admin/structure/piwik_rule"
 *   }
 * )
 */
class PiwikRuleEntity extends ConfigEntityBase implements PiwikRuleEntityInterface {

  protected $id;
  /**
   * The Piwik rule label.
   *
   * @var string
   */
  protected $section;

  protected $regex;

  public function section() {
    return $this->section;
  }

  public function regex() {
    return $this->regex;
  }

}
