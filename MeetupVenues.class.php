<?php


/**
 * Client for the 'venues' grouping of the Meetup API
 *
 * @link http://www.meetup.com/meetup_api/docs
 */
class MeetupVenues extends MeetupApiRequest {


    /**
     * Searches for public venues within a given geo space. To search for
     * specific venues that your group has used, use the getVenues method
     *
     * Required parameters:
     * city | country | lat | lon | state | text | zip
     *
     * @link http://www.meetup.com/meetup_api/docs/2/open_venues/
     * @param <type> $Parameters
     * @return <type>
     */
    public function getOpenVenues( $Parameters ) {
        $required_params = array ( 'city', 'country', 'lat', 'lon', 'state', 'text', 'zip' );
        $url = $this->buildUrl( MEETUP_ENDPOINT_OPEN_VENUES, $Parameters, $required_params );
        echo $url;
        $response =  $this->get( $url )->getResponse();
        return $response['results'];
    }

    /**
     * Search for Meetup venues by one of your groups, events, or venue
     * identifiers. For a full text search on public venues use getOpenVenues
     * 
     * @link http://www.meetup.com/meetup_api/docs/2/venues/
     * @param <type> $Parameters
     * @return <type>
     */
    public function getVenues( $Parameters ) {
        $required_params = array ( 'event_id', 'group_id', 'group_urlname', 'venue_id' );
        $url = $this->buildUrl( MEETUP_ENDPOINT_VENUES, $Parameters, $required_params );
        echo $url;
        $response =  $this->get( $url )->getResponse();
        return $response['results'];
    }
} // end class