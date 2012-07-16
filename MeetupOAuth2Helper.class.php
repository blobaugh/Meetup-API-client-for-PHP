<?php
/**
 * A static helper class to assist with OAuth integration
 */
class MeetupOAuth2Helper {
    /**
     * Redirects the user to the Meetup Request Authentication endpoint
     *
     * @param String $client_id - Your App's client_id obtained from 
     * http://www.meetup.com/meetup_api/oauth_consumers/
     * @param String $redirect_uri - The URI pointing to where you want to 
     * redirect your users after a successful authorization request
     * @return Void
     */
    public static function request_auth($client_id, $redirect_uri) {
        $url = MEETUP_AUTH_URL;

        $params = array(
            "response_type" => "code",
            "client_id" => $client_id,
            "redirect_uri" => $redirect_uri
        );

        $request_to = $url . '?' . http_build_query($params);

        header("Location: " . $request_to);
    }

    /**
     * Request an API access token
     *
     * @throws MeetupInvalidParametersException
     * @throws MeetupBadRequestException
     * @throws MeetupUnauthorizedRequestException
     * @throws MeetupInternalServerErrorException
     * 
     * @param Array $param - An asociative array containing at least the following
     * key-value pairs:
     * 
     * client_id - Your App's key obtained from 
     * http://www.meetup.com/meetup_api/oauth_consumers/
     * client_secret - Your App's secret obtained from 
     * http://www.meetup.com/meetup_api/oauth_consumers/
     * redirect_uri - The URI pointing to where you want to 
     * redirect your users after a successful authorization request
     * code - The code received from an authorization response
     * The $options array may also contain a 'user_agent' to be used for the cURL
     * request
     * 
     * @return String the access token upon a successful request
     * @return Boolean returns false upon unsuccessful request
     */
    public static function request_access_token($params) { 

        $required_params = array('client_id', 'client_secret', 'redirect_uri', 'code');
        foreach ($required_params as $param_key) {
            if ( !array_key_exists($param_key, $params) ) {
                throw new MeetupInvalidParametersException($required_params);
                return FALSE;
            }
        }

        $url = MEETUP_ACCESS_TOKEN_URL;

        # Set up POST parameters to access token endpoint
        $fields = array(
            "code" => $params['code'],
            "client_id" => $params['client_id'],
            "client_secret" => $params['client_secret'],
            "redirect_uri" => $params['redirect_uri'],
            "grant_type" => "authorization_code"
        );

        # Set the cURL options
        $curl_options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => true,    // don't return headers
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_HEADER         => 0,
            CURLOPT_POST           => count($fields),
            CURLOPT_POSTFIELDS     => http_build_query($fields)
        );

        if ( array_key_exists('user_agent', $params) ) {
            $curl_options[CURLOPT_USERAGENT] = $params['user_agent'];
        }

        # Perform the cURL request
        $ch = curl_init( $url );
        curl_setopt_array( $ch, $curl_options );
        $content = curl_exec( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $status_code = $header['http_code'];
        $response_obj = json_decode($content);

        if ( $status_code == "200" ) {
            $access_token = $response_obj->access_token;
            return $access_token;
        } else {
            switch( $status_code ) {
                case "400":
                    throw new MeetupBadRequestException($url, $response_obj->error);
                case "401":
                    throw new MeetupUnauthorizedException();    
                case "500":
                    throw new MeetupInternalServerErrorException();
                default:
                    return FALSE;
            }        
            return FALSE;
        }

        return FALSE;
    }
}
