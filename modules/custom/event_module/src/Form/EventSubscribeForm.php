<?php

namespace Drupal\event_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Messenger\MessengerInterface;

/**
 * Class HelloForm.
 */
class EventSubscribeForm extends FormBase {

  /**
   * Drupal\Core\Messenger\MessengerInterface definition.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;
  /**
   * Constructs a new HelloForm object.
   */
  public function __construct(
    MessengerInterface $messenger
  ) {
    $this->messenger = $messenger;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('messenger')
    );
  }


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'event_subscribe_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['title'] = [
      '#type' => 'item',
      '#title' => $this->t('Subscribe the event(s)'),
      '#description' => '',
    ];
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#description' => '',
      '#maxlength' => 50,
      '#size' => 50,
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#description' => '',
      '#maxlength' => 50,
      '#size' => 50,
    ];
    
    $event_id = null;
    $current_path = \Drupal::service('path.current')->getPath();
    $url_parts = explode('/', $current_path);
    if (in_array('event_entity', $url_parts)) { 
        $event_id = $url_parts[3];
    }    
    $form['event_id'] = [
      '#type' => 'hidden',
      '#value' => $event_id,
      '#id' => 'event-id'
    ];
    
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Subscribe'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
    
    $name = $form_state->getValue('name');
    $email = $form_state->getValue('email');

    if (empty($name)) {
      $form_state->setErrorByName('name', $this->t('Your name is required.'));
    }

    if (empty($email)){
      $form_state->setErrorByName('email', $this->t('Your email is required.'));
    }

    $event_id = $form_state->getValue('event_id'); 
    if (!empty($event_id)) {
        $events = array($event_id);
    } else {
        $events = array_values(\Drupal::service('session')->get('event_id'));
    }
    if (count($events) == 0) {
        $form_state->setErrorByName('name', $this->t('Please select atleast one event.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $subscriber_name = $form_state->getValue('name');
    $email = $form_state->getValue('email');   
    $event_id = $form_state->getValue('event_id'); 
    if (!empty($event_id)) {
        $events = array($event_id);
    } else {
        $events = array_values(\Drupal::service('session')->get('event_id'));
    }
       
    $subscriber = array(
        'name'  => $subscriber_name,
        'email' => $email,        
    ); 
    $res = \Drupal::service('event_module.subscription_manager')->subscribe($events, $subscriber);
    
    drupal_set_message(t('You are subscribed to event successfully'), 'status', TRUE);
    
    // Redirect
    $form_state->setRedirect('event_module.view');
    return;
  }

}

