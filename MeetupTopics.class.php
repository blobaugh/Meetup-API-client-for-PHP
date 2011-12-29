<?php


/**
 * Client for the 'rsvps' grouping of the Meetup API
 *
 * @link http://www.meetup.com/meetup_api/docs
 */
class MeetupTopics extends MeetupApiRequest {

    /**
     * Returns results of search for given topic parameters
     *
     * @link http://www.meetup.com/meetup_api/docs/topics/
     * @param <type> $Parameters
     * @return <type>
     */
    public function getTopics( $Parameters ) {
        $url = $this->buildUrl( MEETUP_ENDPOINT_TOPICS, $Parameters );
        echo $url;
        $response =  $this->get( $url )->getResponse();
        return $response['results'];
    }
} // end class