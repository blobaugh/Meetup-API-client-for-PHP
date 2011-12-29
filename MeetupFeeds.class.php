<?php

/**
 * Client for the 'feeds' grouping of the Meetup API
 *
 * @link http://www.meetup.com/meetup_api/docs
 */
class MeetupFeeds extends MeetupApiRequest {

    /**
     * Returns a user's activity. If no user is specified the user connected to
     * the API key in use' activity will be returned
     *
     * @link http://www.meetup.com/meetup_api/docs/2/checkins/
     * @param Array $Parameters
     * @return Array
     */
    public function getActivity( $Parameters = array() ) {
        $url = $this->buildUrl( MEETUP_ENDPOINT_FEED_ACTIVITY, $Parameters );
        echo $url;
        $response =  $this->get( $url )->getResponse();
        return $response['results'];
    }

} // end class