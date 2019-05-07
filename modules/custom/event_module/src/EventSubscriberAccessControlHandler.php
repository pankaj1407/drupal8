<?php

namespace Drupal\event_module;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Event subscriber entity.
 *
 * @see \Drupal\event_module\Entity\EventSubscriber.
 */
class EventSubscriberAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\event_module\Entity\EventSubscriberInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished event subscriber entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published event subscriber entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit event subscriber entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete event subscriber entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add event subscriber entities');
  }

}
