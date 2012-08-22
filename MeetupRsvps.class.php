<?php


/**
 * Client for the 'rsvps' grouping of the Meetup API
 *
 * @link http://www.meetup.com/meetup_api/docs
 */
class MeetupRsvps extends MeetupApiRequest {

    /**
     * Returns rsvps for a given event
     *
     * Required parameters:
     * event_id
     *
     * @link http://www.meetup.com/meetup_api/docs/2/rsvps/
     * @param <type> $Parameters
     * @return <type>
     */
    public function getRsvps( $Parameters ) {
        $required_params = array( 'event_id');
        $url = $this->buildUrl( MEETUP_ENDPOINT_RSVPS, $Parameters, $required_params );

        $response =  $this->get( $url )->getResponse();
        return $response['results'];
    }
} // end class