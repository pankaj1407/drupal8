<?php

namespace Drupal\event_module;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Event subscriber entities.
 *
 * @ingroup event_module
 */
class EventSubscriberListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Event subscriber ID');
    $header['name']  = $this->t('Name');
    $header['email'] = $this->t('Email');
    $header['event'] = $this->t('Subscribed Event');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\event_module\Entity\EventSubscriber */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.event_subscriber.edit_form',
      ['event_subscriber' => $entity->id()]
    );
    $row['email'] = $entity->getEmail();
    $row['event'] = Link::createFromRoute(
      $entity->getEvent()->getName(),
      'entity.event_entity.edit_form',
      ['event_entity' => $entity->getEventId()]
    );

    return $row + parent::buildRow($entity);
  }

}
