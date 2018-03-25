<?php

namespace Drupal\oe_piwik\EventSubscriber;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Url;
use Drupal\oe_piwik\PiwikEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * oe_piwik event subscriber.
 */
class PiwikSiteSettings implements EventSubscriberInterface {

  protected $config;

  protected $requestStack;

  public function __construct(ConfigFactoryInterface $config_factory, $request_stack) {
    $this->config = $config_factory->get('oe_webtools.piwik');
    $this->requestStack = $request_stack;
  }


  /**
   * Kernel request event handler.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   *   Response event.
   */
  public function setSiteDefaults(PiwikEvent $event) {

    // SiteID
    $site_id = $this->config->get('site_id');
    if ($site_id) {
      $event->setSiteId((int) $site_id);
    }

    // SitePath
    $site_path = $this->config->get('site_path');
    if ($site_path) {
      $event->setSitePath($site_path);
    }
    else {
      // @todo Is there another way of determining this?
      $event->setSitePath($_SERVER['HTTP_HOST'] . Url::fromRoute('<front>')->toString());
    }

    // Set exception flags when access is denied, or page not found.
    $request_exception = $this->requestStack->getCurrentRequest()->attributes->get('exception');
    if ($request_exception instanceof NotFoundHttpException) {
      $event->setIs404Page();
    }
    if ($request_exception instanceof AccessDeniedHttpException) {
      $event->setIs403Page();
    }
    
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      PiwikEvent::NAME => ['setSiteDefaults'],
    ];
  }

}
