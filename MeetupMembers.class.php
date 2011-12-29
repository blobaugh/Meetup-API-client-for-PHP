<?php

/**
 * Client for the 'members' grouping of the Meetup API
 *
 * @link http://www.meetup.com/meetup_api/docs
 */
class MeetupMembers extends MeetupApiRequest {

    /**
     * Returns all members matching the given criteria
     *
     * Required parameters:
     * group_id | group_urlname | member_id | service | topic,groupnum
     *
     * @link http://www.meetup.com/meetup_api/docs/2/members
     * @param Array $Parameters
     * @return Array
     */
    public function getMembers( $Parameters ) {
        $required_params = array( 'group_id', 'group_urlname', 'member_id', 'service', 'topic,groupnum');
        $url = $this->buildUrl( MEETUP_ENDPOINT_MEMBERS, $Parameters, $required_params );
        echo $url;
        $response =  $this->get( $url )->getResponse();
        return $response['results'];
    }

    /**
     * Returns the specified user information
     *
     * @link http://www.meetup.com/meetup_api/docs/2/member/#get
     * @param Integer $MemberId
     * @param Array $Parameters - optional
     * @return Array
     */
    public function getMember( $MemberId, $Parameters = array() ) {
        $url = $this->buildUrl( MEETUP_ENDPOINT_MEMBER . "/$MemberId", $Parameters );
        echo $url;
        $response =  $this->get( $url )->getResponse();
        return $response;
    }

    /**
     * This method returns member profiles associated with a particular group.
     * Meetup members have separate profiles for each group they join.
     *
     * Required parameters:
     * group_id | group_urlname | topic,groupnm
     *
     * @link http://www.meetup.com/meetup_api/docs/2/profiles/
     * @param Array $Parameters
     * @return Array
     */
    public function getProfiles( $Parameters ) {
        $required_params = array( 'group_id', 'group_urlname', 'topic,groupnum');
        $url = $this->buildUrl( MEETUP_ENDPOINT_PROFILES, $Parameters, $required_params );
        echo $url;
        $response =  $this->get( $url )->getResponse();
        return $response['results'];
    }
} // end class