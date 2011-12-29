<?php

/**
 * Client for the 'checkins' grouping of the Meetup API
 *
 * @link http://www.meetup.com/meetup_api/docs
 */
class MeetupCheckins extends MeetupApiRequest {


    /**
     * Returns a listing of all member checkins fitting the given parameters
     *
     * Required paramters:
     * event_id | group_id | member_id
     *
     * @link http://www.meetup.com/meetup_api/docs/2/checkins/
     * @param Array $Parameters
     * @return Array
     */
    public function getCheckins( $Parameters) {
        $required_params = array( 'event_id', 'group_id', 'member_id' );
        $url = $this->buildUrl( MEETUP_ENDPOINT_CHECKINS, $Parameters, $required_params );
        $response =  $this->get( $url )->getResponse();
        return $response['results'];
    }
} // end class