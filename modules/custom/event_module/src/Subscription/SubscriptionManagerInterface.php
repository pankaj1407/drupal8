<?php

namespace Drupal\event_module\Subscription;

/**
 * Subscription management; subscribe
 */
interface SubscriptionManagerInterface {

  /**
   * Subscribe a user to a event.
   *
   * @param string $mail
   *   The email address to subscribe to the event.
   * @param string $event_id
   *   The Event Entity ID.
   *
   * @return $this
   */
  public function subscribe($mail, $event_id);

}
