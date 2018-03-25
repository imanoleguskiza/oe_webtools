<?php

namespace Drupal\oe_piwik_rules\EventSubscriber;

use Drupal\oe_piwik\PiwikEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Piwik Section Rules event subscriber.
 *
 * @todo Dependency injection.
 */
class PiwikSectionRules implements EventSubscriberInterface {

  public function setSection(PiwikEvent $event) {
    $storage = \Drupal::entityTypeManager()->getStorage('piwik_rule');
    $rules = $storage->loadMultiple();
    $current_uri = \Drupal::request()->getRequestUri();
    /** @var \Drupal\oe_piwik_rules\Entity\PiwikRuleEntityInterface $rule */
    foreach ($rules as $rule) {
      if (preg_match($rule->regex() , $current_uri, $matches) === 1) {
        $event->setSiteSection($rule->section());
      }
    }

  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      PiwikEvent::NAME => ['setSection'],
    ];
  }

}
