<?php

namespace Drupal\event_module\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Defines the Event entity entity.
 *
 * @ingroup event_module
 *
 * @ContentEntityType(
 *   id = "event_entity",
 *   label = @Translation("Event entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\event_module\EventEntityListBuilder",
 *     "views_data" = "Drupal\event_module\Entity\EventEntityViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\event_module\Form\EventEntityForm",
 *       "add" = "Drupal\event_module\Form\EventEntityForm",
 *       "edit" = "Drupal\event_module\Form\EventEntityForm",
 *       "delete" = "Drupal\event_module\Form\EventEntityDeleteForm",
 *     },
 *     "access" = "Drupal\event_module\EventEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\event_module\EventEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "event_entity",
 *   admin_permission = "administer event entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/content/event_entity/{event_entity}",
 *     "add-form" = "/admin/structure/event_entity/add",
 *     "edit-form" = "/admin/structure/event_entity/{event_entity}/edit",
 *     "delete-form" = "/admin/structure/event_entity/{event_entity}/delete",
 *     "collection" = "/admin/structure/event_entity",
 *   },
 *   field_ui_base_route = "event_entity.settings"
 * )
 */
class EventEntity extends ContentEntityBase implements EventEntityInterface {

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
  public function getEventDate() {
    return $this->get('event_date')->value;
  }


  /**
   * {@inheritdoc}
   */
  public function getEventVenue() {
    return $this->get('venue')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getEventType() {
    return $this->get('event_type')->entity;
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

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Event entity entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE);
      //->setDisplayOptions('view', [
      //  'label' => 'hidden',
      //  'type' => 'author',
      //  'weight' => 0,
      //])
      //->setDisplayOptions('form', [
      //  'type' => 'entity_reference_autocomplete',
      //  'weight' => 5,
      //  'settings' => [
      //    'match_operator' => 'CONTAINS',
      //    'size' => '60',
      //    'autocomplete_type' => 'tags',
      //    'placeholder' => '',
      //  ],
      //]);
      //->setDisplayConfigurable('form', TRUE)
      //->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Event Name'))
      ->setDescription(t('The name of the Event entity entity.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Event entity is published.'))
      ->setDefaultValue(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => -3,
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    $fields['event_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Event Date'))
      ->setDescription(t('Event Date'))      
      ->setSettings([
        'datetime_type' => 'datetime'
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'datetime_default',
        'settings' => [
          'format_type' => 'medium',
        ],
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'datetime_default',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);
    
    $fields['event_type'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Event Type'))
      ->setDescription(t('Event Categories'))
      ->setSetting('target_type', 'taxonomy_term')
      ->setSetting('handler_settings', ['target_bundles' => ['event_type' => 'event_type'], 'auto_create' => TRUE])      
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'author',
        'weight' => -3,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
        ),
        'weight' => -3,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);
      
    $fields['venue'] = BaseFieldDefinition::create('string')
    ->setLabel(t('Event Venue'))
    ->setDescription(t('Event Venue'))
    ->setSettings(array(
        'max_length' => 255,
        'text_processing' => 0,
    ))
    ->setDefaultValue('')
    ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
    ))
    ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
    ))
    ->setDisplayConfigurable('form', TRUE)
    ->setDisplayConfigurable('view', TRUE)
    ->setRequired(TRUE);
    
    $fields['description'] = BaseFieldDefinition::create('text_long')
    ->setLabel(t('Event Details'))
    ->setDescription(t('Event Details'))
    ->setSettings(array(
        'max_length' => 255,
        'text_processing' => 0,
    ))
    ->setDefaultValue('')
    ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
    ))
    ->setDisplayOptions('form', array(
        'type' => 'string_textarea',
        'weight' => -4,
    ))
    ->setDisplayConfigurable('form', TRUE)
    ->setDisplayConfigurable('view', TRUE)
    ->setRequired(TRUE);
    
    return $fields;
  }

}
