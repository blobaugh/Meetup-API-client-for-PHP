<?php
/**
 * The collection of parameters needed to make requests against the Meetup API.
 * Currently only supports api key authentication, but can be extended to
 * support oAuth.
 */
class MeetupConnection {
    public $allowed_auth_types = array('key');
    public $auth_type;
    public $auth_params;
    /*
     * Initializes a connection to the Meetup API
     * 
     * @param String $auth_type - The authentication type. Only 'key' is supported
     */
    public function __construct($auth_type, $params=array()) {
        if (in_array($auth_type, $this->allowed_auth_types)) {
            $this->auth_type = $auth_type;
            if ($auth_type == 'key') {
                if (array_key_exists('key', $params))
                    $this->auth_params = $params;
                else
                    throw new Exception('Invalid parameters for MeetupConnection construction');
            }
        } else {
            throw new Exception('Invalid parameters for MeetupConnection construction');
        }
    }
}
