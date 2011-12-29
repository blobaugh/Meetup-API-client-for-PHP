<?php

/**
 * Client for the 'photos' grouping of the Meetup API
 *
 * @link http://www.meetup.com/meetup_api/docs
 */
class MeetupPhotos extends MeetupApiRequest {

    /**
     * This method returns comments on meetup photos.
     *
     * Required parameters:
     * photo_id
     *
     * @link http://www.meetup.com/meetup_api/docs/2/photo_comments/
     * @param Array $Parameters
     * @return Array
     */
    public function getComments( $Parameters ) {
        $required_params = array( 'photo_id');
        $url = $this->buildUrl( MEETUP_ENDPOINT_PHOTO_COMMENTS, $Parameters, $required_params );
        echo $url;
        $response =  $this->get( $url )->getResponse();
        return $response;
    }

    /**
     * This method returns photo albums associated with Meetup groups.
     *
     * Required parameters:
     * event_id | group_id | photo_album_id
     *
     * @link http://www.meetup.com/meetup_api/docs/2/photo_albums/
     * @param Array $Parameters
     * @return Array
     */
    public function getAlbums( $Parameters ) {
        $required_params = array( 'event_id', 'group_id', 'photo_album_id');
        $url = $this->buildUrl( MEETUP_ENDPOINT_PHOTO_ALBUMS, $Parameters, $required_params );
        echo $url;
        $response =  $this->get( $url )->getResponse();
        return $response['results'];
    }

    /**
     * Returns photos matching the given criteria
     *
     * Required parameters:
     * event_id | group_id | photo_album_id | member_id | photo_id | tagged
     *
     * @link http://www.meetup.com/meetup_api/docs/2/photo_albums/
     * @param <type> $Parameters
     * @return <type>
     */
    public function getPhotos( $Parameters ) {
        $required_params = array( 'event_id', 'group_id', 'photo_album_id', 'member_id', 'photo_id', 'tagged');
        $url = $this->buildUrl( MEETUP_ENDPOINT_PHOTOS, $Parameters, $required_params );
        echo $url;
        $response =  $this->get( $url )->getResponse();
        return $response['results'];
    }
} // end class