<?php

/**
 * @file
 * Contains event_subscriber.page.inc.
 *
 * Page callback for Event subscriber entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Event subscriber templates.
 *
 * Default template: event_subscriber.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_event_subscriber(array &$variables) {
  // Fetch EventSubscriber Entity Object.
  $event_subscriber = $variables['elements']['#event_subscriber'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
