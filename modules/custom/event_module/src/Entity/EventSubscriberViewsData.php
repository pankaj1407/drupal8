<?php

namespace Drupal\event_module\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Event subscriber entities.
 */
class EventSubscriberViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
