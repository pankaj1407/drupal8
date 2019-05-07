<?php

namespace Drupal\event_module\Subscription;

use Drupal\event_module\Subscription\SubscriptionManagerInterface;
use Drupal\event_module\Entity\EventSubscriber;
/**
 * Default subscription manager.
 */
class SubscriptionManager implements SubscriptionManagerInterface {

  public function __construct() {

  }

  /**
   * {@inheritdoc}
   */
  public function subscribe($event_id, $subscriber=array()) {
  
    $subscriber_name = $subscriber['name'];
    $mail = $subscriber['email'];
    
    $account = user_load_by_mail($mail);
    if (!$account) {
        $language = \Drupal::languageManager()->getCurrentLanguage()->getId();
        $user = \Drupal\user\Entity\User::create();

        //Mandatory settings
        $user->setPassword(user_password());
        $user->enforceIsNew();
        $user->setEmail($mail);
        $user->setUsername($mail); //This username must be unique and accept only a-Z,0-9, - _ @ .

        //Optional settings
        $user->set("init", 'email');
        $user->set("langcode", $language);
        $user->set("preferred_langcode", $language);
        $user->set("preferred_admin_langcode", $language);
        //$user->activate();
        $user->block();

        //Save user
        $account = $user->save();
        $user_id = $user->id();
    } else {
        $user_id = $account->id();
    }
    if ($user_id) {
        if (!is_array($event_id)) {
            $event_subscriber_mgr = \Drupal::entityTypeManager()->getStorage('event_subscriber');
            $event_subscriber = $event_subscriber_mgr->loadByProperties(['event_id' => $event_id, 'email' => $mail]);
            if ($event_subscriber) {
                return false;
            }
            $subscriber = EventSubscriber::create(array());
            $subscriber->setName($subscriber_name);
            $subscriber->setEmail($mail);
            $subscriber->setEvent($event_id);
            $subscriber->setOwnerId($user_id);
            $subscriber->setPublished(1);
            $subscriber->save();
                        
        } else {

            foreach($event_id as $eid) {
                $event_subscriber_mgr = \Drupal::entityTypeManager()->getStorage('event_subscriber');
                $event_subscriber = $event_subscriber_mgr->loadByProperties(['event_id' => $eid, 'email' => $mail]);
                if (!$event_subscriber) {
                    $subscriber = EventSubscriber::create(array());
                    $subscriber->setName($subscriber_name);
                    $subscriber->setEmail($mail);
                    $subscriber->setEvent($eid);
                    $subscriber->setOwnerId($user_id);
                    $subscriber->setPublished(1);
                    $subscriber->save();  
                }
            }
        }
    }
  }
}
