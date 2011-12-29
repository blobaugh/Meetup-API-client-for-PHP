<?php


/**
 * Client for the 'events' grouping of the Meetup API
 *
 * @link http://www.meetup.com/meetup_api/docs
 */
class MeetupEvents extends MeetupApiRequest {

    /**
     * Return all events that fit the given parameters
     *
     * Required Parameters:
     * event_id | group_id | group_urlname | member_id | venue_id
     *
     * @link http://www.meetup.com/meetup_api/docs/2/events
     * @param Array $Parameters
     * @return Array
     */
    public function getEvents( $Parameters) { 
        $required_params = array( 'event_id', 'group_id', 'group_urlname', 'member_id', 'venue_id' );
        $url = $this->buildUrl( MEETUP_ENDPOINT_EVENTS, $Parameters, $required_params );
        $response =  $this->get( $url )->getResponse();
        return $response['results'];
    }

    /**
     * Return information on a specific event by id
     *
     * @link http://www.meetup.com/meetup_api/docs/2/event/#get
     * @param String $Id
     * @param Array $Parameters
     * @return Array
     */
    public function getEvent( $Id, $Parameters ) {
        $url = $this->buildUrl( MEETUP_ENDPOINT_EVENT . "/$Id", $Parameters );
        $response =  $this->get( $url )->getResponse();
        return $response;

    }

    /**
     * Does a search for all open events fiting the given parameters
     *
     * Required paramters:
     * city | country | lat | lon | state | text | topic | zip (US only)
     *
     * @link http://www.meetup.com/meetup_api/docs/2/open_events
     * @param Array $Parameters
     * @return Array    
     */
    public function getOpenEvents( $Parameters ) {
        $required_params = array( 'city', 'country', 'lat', 'lon', 'state', 'text', 'topic', 'zip' );
        $url = $this->buildUrl( MEETUP_ENDPOINT_OPEN_EVENTS, $Parameters, $required_params );
        $response =  $this->get( $url )->getResponse();
        return $response['results'];
    }


    /**
     * Returns all the comments for the specified event(s)
     *
     * Required parameters:
     * event_id | group_id | member_id
     *
     * @link http://www.meetup.com/meetup_api/docs/2/event_comments
     * @param Array $Parameters
     * @return Array
     */
    public function getEventComments( $Parameters) {
        $required_params = array( 'event_id', 'group_id', 'member_id' );
        $url = $this->buildUrl( MEETUP_ENDPOINT_EVENT_COMMENTS, $Parameters, $required_params );
        $response =  $this->get( $url )->getResponse();
        return $response['results'];
    }

    /**
     * Returns all the ratings for a specific event
     *
     * Required parameters:
     * event_id
     *
     * @link http://www.meetup.com/meetup_api/docs/2/event_ratings
     * @param Array $Parameters
     * @return Array
     */
    public function getEventRatings( $Parameters) {
        $required_params = array( 'event_id' );
        $url = $this->buildUrl( MEETUP_ENDPOINT_EVENT_RATINGS, $Parameters, $required_params );
        $response =  $this->get( $url )->getResponse();
        return $response['results'];
    }
} // end class