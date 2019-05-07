<?php

namespace Drupal\event_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller routines for events routes.
 */
class EventController extends ControllerBase {
    
    /**
     * Private method for queries
     * 
     * @param integer $tid
     * @return array
     */
    private function getEvents($tid=null) {
        
        $events = [];
        $connection = \Drupal::database();
        $query = $connection->select('event_entity', 'e')
          ->fields('e', ['id', 'name', 'event_date', 'venue', 'description__value'])
          ->fields('t', ['name']);
        $query->join('taxonomy_term_field_data', 't', 't.tid = e.event_type');       
        $query->condition('e.status', 1);
        //$query->condition('e.event_date', date( "Y-m-d\TH:i:s"),'>=');
        if ($tid) {
            $query->condition('e.event_type', $tid);
        }
        $query->orderBy("e.event_date", 'DESC');        
        $query = $query->extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit(5); // Pager limited to 5
               
        $result = $query->execute();
        
        if ($result) {
            $events = $result->fetchAll();
        }
        
        
        return $events;
    }   
    
    /**
     * Listing of all events.
     *
     * @return array
     *   An array representing the listing of all events content.
     */
    public function viewEvents() {

        $events = $this->getEvents();    

        return [
          '#theme' => 'events_list',
          '#events' => $events,
          '#attached' => [
              'library' => [
                 'event_module/event_module.subscribe',
              ],
           ],            
        ];
    }

    /**
     * View events by categories/event type
     * 
     * @param integer $tid
     * @param Request $request
     * @return theme
     */
    public function viewEventsByType($tid, Request $request) {

        $events = $this->getEvents($tid);    

        return [
          '#theme' => 'events_list',
          '#events' => $events,
        ];      
    }
    
    /**
     * Ajax request to subscribe events
     * 
     * @param Request $request
     * @return type
     */
    public function subscribeEvents(Request $request) {
        
        $event_id = $request->get('event_id');
        $checked  = $request->get('checked');
        $session = $request->getSession();
        
        if ($session->has('event_id')) {
            $events = $session->get('event_id');
            $events[$event_id] = $event_id;
        } else {
            $events = array($event_id => $event_id);
        }
       
        if ($checked == 2) {
            unset($events[$event_id]);
        }
        $session->set('event_id', $events);
        
        return $event_id;
    }
}