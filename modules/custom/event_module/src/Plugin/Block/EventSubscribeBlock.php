<?php
/**
 * @file
 * Contains \Drupal\event_module\Plugin\Block\EventSubscribeBlock.
 */
namespace Drupal\event_module\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a 'event_subscribe_block' block.
 *
 * @Block(
 *   id = "event_subscribe_block",
 *   admin_label = @Translation("Event Subscribe block"),
 *   category = @Translation("Event Subscribe block")
 * )
 */
class EventSubscribeBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\event_module\Form\EventSubscribeForm');
    return $form;
   }
}