<?php

namespace Drupal\event_module\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Event entity entities.
 *
 * @ingroup event_module
 */
interface EventEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Event entity name.
   *
   * @return string
   *   Name of the Event entity.
   */
  public function getName();

  /**
   * Sets the Event entity name.
   *
   * @param string $name
   *   The Event entity name.
   *
   * @return \Drupal\event_module\Entity\EventEntityInterface
   *   The called Event entity entity.
   */
  public function setName($name);

  /**
   * Gets the Event entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Event entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Event entity creation timestamp.
   *
   * @param int $timestamp
   *   The Event entity creation timestamp.
   *
   * @return \Drupal\event_module\Entity\EventEntityInterface
   *   The called Event entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Event entity published status indicator.
   *
   * Unpublished Event entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Event entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Event entity.
   *
   * @param bool $published
   *   TRUE to set this Event entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\event_module\Entity\EventEntityInterface
   *   The called Event entity entity.
   */
  public function setPublished($published);

}
