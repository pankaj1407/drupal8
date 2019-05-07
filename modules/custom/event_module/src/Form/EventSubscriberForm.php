<?php

namespace Drupal\event_module\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Event subscriber edit forms.
 *
 * @ingroup event_module
 */
class EventSubscriberForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\event_module\Entity\EventSubscriber */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Event subscriber.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Event subscriber.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.event_subscriber.canonical', ['event_subscriber' => $entity->id()]);
  }

}
