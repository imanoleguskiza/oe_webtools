<?php

namespace Drupal\oe_piwik;

use JsonSerializable;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class PiwikEvent
 *
 * @see https://webgate.ec.europa.eu/fpfis/wikis/pages/viewpage.action?spaceKey=webtools&title=Piwik
 */
class PiwikEvent extends Event implements JsonSerializable {
  const NAME = 'piwik_data_collection';

  protected $siteId;

  protected $sitePath;

  protected $siteSection;

  protected $is404;

  protected $is403;

  protected $lang;

  protected $instance;

  public $search;

  public function __construct() {
    $this->search = new PiwikSearch();
  }

  public function setSiteId(int $id) {
    $this->siteId = $id;
  }

  public function setSitePath(string $path) {
    $this->sitePath = $path;
  }

  public function isValid() {
    // SiteId is required.
    if (!$this->siteId) {
      return FALSE;
    }
    return TRUE;
  }

  public function setIs404Page(bool $is_404 = TRUE) {
    $this->is404 = $is_404;
  }

  public function setIs403Page(bool $is_403 = TRUE) {
    $this->is403 = $is_403;
  }

  public function setLanguageCode(string $lang_code) {
    $this->setLanguageCode($lang_code);
  }

  public function setInstance($instance) {
    $this->instance = $instance;
  }

  function jsonSerialize() {
    $data = [
      'siteID' => $this->siteId,
      'sitePath' => $this->sitePath,
      'siteSection' => $this->siteSection,
      'is404' => $this->is404,
      'is403' => $this->is403,
      'lang' => $this->lang,
      'instance' => $this->instance,
    ];
    if ($this->search->isSet()) {
      $data['search'] = $this->search;
    }

    return array_filter($data);
  }

  public function __toString() {
    return json_encode($this);
  }

}
