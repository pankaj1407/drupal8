<?php

namespace Drupal\event_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a user details block.
 *
 * @Block(
 * id = "event_block",
 * admin_label = @Translation("Events Block")
 * )
 */
class EventBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {
        
        $current_path = \Drupal::service('path.current')->getPath();
        $url_parts = explode('/', $current_path);
        
        $current_tid = isset($url_parts[2]) ? $url_parts[2] : null;
        
        $events_types = $this->getEventTypes();

        return [
          '#theme' => 'events_types_block',
          '#events_types' => $events_types,
          '#title' => t('Events by type'),
          '#current_tid'=> $current_tid,
        ];
         
    }

    private function getEventTypes()
    {
        $events = [];
        $connection = \Drupal::database();
        $query = $connection->select('event_entity', 'e')          
          ->fields('t', ['tid', 'name']);
        $query->addExpression('count(e.id)', 'events_count');
        $query->join('taxonomy_term_field_data', 't', 't.tid = e.event_type');       
        $query->condition('e.status', 1);
        //$query->condition('e.event_date', date( "Y-m-d\TH:i:s"),'>=');
        $query->groupBy("t.tid");
        $query->groupBy("t.name"); 
        $result = $query->execute();
        if ($result) {
            $events = $result->fetchAll();
        }
        //kint($events);
        return $events;        
    }
}
