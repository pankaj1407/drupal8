<?php

namespace Drupal\event_module;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Event entity entities.
 *
 * @ingroup event_module
 */
class EventEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Event entity ID');
    $header['name'] = $this->t('Event Name');
    $header['event_date'] = $this->t('Event Date');
    $header['event_venue'] = $this->t('Event Venue');
    $header['event_type'] = $this->t('Event Type');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\event_module\Entity\EventEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.event_entity.edit_form',
      ['event_entity' => $entity->id()]
    );
    $row['event_date'] = $entity->getEventDate();
    $row['event_venue'] = $entity->getEventVenue();
    $row['event_type'] = $entity->getEventType()->getName();
    return $row + parent::buildRow($entity);
  }

}
