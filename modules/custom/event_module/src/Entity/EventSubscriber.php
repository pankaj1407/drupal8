<?php

namespace Drupal\event_module\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Event subscriber entity.
 *
 * @ingroup event_module
 *
 * @ContentEntityType(
 *   id = "event_subscriber",
 *   label = @Translation("Event subscriber"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\event_module\EventSubscriberListBuilder",
 *     "views_data" = "Drupal\event_module\Entity\EventSubscriberViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\event_module\Form\EventSubscriberForm",
 *       "add" = "Drupal\event_module\Form\EventSubscriberForm",
 *       "edit" = "Drupal\event_module\Form\EventSubscriberForm",
 *       "delete" = "Drupal\event_module\Form\EventSubscriberDeleteForm",
 *     },
 *     "access" = "Drupal\event_module\EventSubscriberAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\event_module\EventSubscriberHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "event_subscriber",
 *   admin_permission = "administer event subscriber entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/event_subscriber/{event_subscriber}",
 *     "add-form" = "/admin/structure/event_subscriber/add",
 *     "edit-form" = "/admin/structure/event_subscriber/{event_subscriber}/edit",
 *     "delete-form" = "/admin/structure/event_subscriber/{event_subscriber}/delete",
 *     "collection" = "/admin/structure/event_subscriber",
 *   },
 *   field_ui_base_route = "event_subscriber.settings"
 * )
 */
class EventSubscriber extends ContentEntityBase implements EventSubscriberInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getEmail() {
    return $this->get('email')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setEmail($name) {
    $this->set('email', $name);
    return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public function setEvent($event_id) {
    $this->set('event_id', $event_id);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getEvent() {
    return $this->get('event_id')->entity;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getEventId() {
    return $this->get('event_id')->target_id;
  }
  
  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Event subscriber.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setRequired(TRUE);
    
    $fields['email'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Email'))
      ->setDescription(t('The email of the Event subscriber.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('form', [
        'type' => 'email_default',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setRequired(TRUE);    

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('User'))
      ->setDescription(t('The corresponding user.'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default');
    
    
    $fields['event_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Event'))
      ->setDescription(t('The Subscribed Event.'))
      ->setSetting('target_type', 'event_entity')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);    
    
    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Status'))
      ->setDescription(t('Boolean indicating the status of the subscriber.'))
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
