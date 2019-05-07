<?php

/**
 * @file
 * Contains event_entity.page.inc.
 *
 * Page callback for Event entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Event entity templates.
 *
 * Default template: event_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_event_entity(array &$variables) {
  // Fetch EventEntity Entity Object.
  $event_entity = $variables['elements']['#event_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}


/**
 * Prepares variables for events list templates.
 *
 * Default template: events-list.html.twig.
 *
 * @param array $variables
 *   An array containing the following elements:
 *   - events: An array of all events objects to display
 */
function event_module_preprocess_events_list(&$variables) {

    $variables['events']['pager'] = array(
      '#type' => 'pager',
    );
    
}

/**
 * Prepares variables for events list templates.
 *
 * Default template: events-types-block.html.twig.
 *
 * @param array $variables
 *   An array containing the following elements:
 *   - events_types: An array of all events objects to display
 */
function event_module_preprocess_events_types_block(&$variables) {

}

/**
* Implements hook_preprocess_HOOK() for HTML document templates.
*
* Add block in a region.
*/
function event_module_preprocess_html(&$variables) {
    $current_path = \Drupal::service('path.current')->getPath();
    $url_parts = explode('/', $current_path);
    if (in_array('view-events', $url_parts) || in_array('event_entity', $url_parts)) { 

        $block_manager = \Drupal::service('plugin.manager.block');
        // configuration or you load from settings.
        $config = [];
        $plugin_block = $block_manager->createInstance('event_block', $config);
        $block_content = $plugin_block->build();

        $plugin_block = $block_manager->createInstance('event_subscribe_block', $config);
        $event_subscribe_block = $plugin_block->build();
        //kint($event_subscribe_block);
        if (isset($variables['page']['sidebar_first'])) {
            $variables['page']['sidebar_first'] = array_merge(array($block_content),$variables['page']['sidebar_first']);
            $variables['page']['sidebar_first'][] = $event_subscribe_block;
        } else {
            $variables['page']['content'] = array_merge(array($block_content),$variables['page']['content']);
            $variables['page']['content'][] = $event_subscribe_block;
        }
        $variables['#attached']['library'][] = 'event_module/event_module.assets';
    }
}