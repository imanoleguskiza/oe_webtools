<?php
namespace Drupal\oe_piwik;

use JsonSerializable;

class PiwikSearch implements JsonSerializable {
  protected $keyword;

  protected $category;

  protected $count;

  /**
   * @param string $keyword
   */
  public function setKeyword(string $keyword) {
    $this->keyword = $keyword;
  }

  /**
   * @param string $category
   */
  public function setCategory(string $category) {
    $this->category = $category;
  }

  /**
   * @param int $count
   */
  public function setCount(int $count) {
    $this->count = $count;
  }

  public function isSet() {
    return !empty($this->keyword);
  }

  function jsonSerialize() {
    $data = [
      'keywords' => $this->keyword,
      'category' => $this->category,
      'count' => $this->count,
    ];
    return array_filter($data);
  }

}
