<?php

namespace Drupal\event_module\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Event subscriber entities.
 *
 * @ingroup event_module
 */
interface EventSubscriberInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Event subscriber name.
   *
   * @return string
   *   Name of the Event subscriber.
   */
  public function getName();

  /**
   * Sets the Event subscriber name.
   *
   * @param string $name
   *   The Event subscriber name.
   *
   * @return \Drupal\event_module\Entity\EventSubscriberInterface
   *   The called Event subscriber entity.
   */
  public function setName($name);

  /**
   * Gets the Event subscriber creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Event subscriber.
   */
  public function getCreatedTime();

  /**
   * Sets the Event subscriber creation timestamp.
   *
   * @param int $timestamp
   *   The Event subscriber creation timestamp.
   *
   * @return \Drupal\event_module\Entity\EventSubscriberInterface
   *   The called Event subscriber entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Event subscriber published status indicator.
   *
   * Unpublished Event subscriber are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Event subscriber is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Event subscriber.
   *
   * @param bool $published
   *   TRUE to set this Event subscriber to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\event_module\Entity\EventSubscriberInterface
   *   The called Event subscriber entity.
   */
  public function setPublished($published);

}
