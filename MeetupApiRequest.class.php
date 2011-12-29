<?php





class MeetupApiRequest {

    /**
     * Default constructor
     */
    public function __construct() {}

    /**
     * Performs the GET query against the specified endpoint
     *
     * @throws MeetupBadRequestException
     * @throws MeetupUnauthorizedRequestException
     * @throws MeetupInternalServerErrorException
     * @param String $Url - Endpoint with URL paramters (for now)
     * @return MeetupApiResponse
     */
    public function get( $Url ) {
        // Clear error status
        $ret = false;
        
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => true,    // don't return headers
            CURLOPT_USERAGENT      => "PHP Meetup.com API Client", // who am i
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_HEADER => 0
        );
//echo $Url;
        $ch = curl_init( $Url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );
        $header['content'] = $content;

        $response = new MeetupApiResponse();
        $response->setHttpCode($header['http_code']);
        $response->setResponse($header['content']);
        


        if( $response->getHttpCode() == '400' ) {
            // 400 Bad request when there was a problem with the request
            throw new MeetupBadRequestException($Url, $response);
        } else if ( $response->getHttpCode() == '401' ) {
            // 401 Unauthorized when you don't provide a valid key
            throw new MeetupUnauthorizedRequestException();
        } else if ( $response->getHttpCode() == '500' ) {
            // 500 Internal Server Error
            throw new MeetupInternalServerErrorException();
        }

        return $response;
    }

    /**
     *
     * @throws MeetupInvalidParametersException
     * @param <type> $Endpoint
     * @param <type> $Parameters
     * @param <type> $RequiredParameters - Optional - Some endpoints do not have parameters
     * @return <type>
     */
    public function buildUrl( $Endpoint, $Parameters, $RequiredParameters = null ) {
        if(is_array($RequiredParameters) && !$this->verifyParameters( $RequiredParameters, $Parameters )) {
            throw new MeetupInvalidParametersException( $RequiredParameters );
        }
        $params = '';
        foreach($Parameters AS $k => $v) {
            $params .= "&$k=$v";
        }
        return MEETUP_API_URL . $Endpoint . "?key=" . MEETUP_API_KEY . $params;
    }

    /**
     * Checks the input parameters against a list of required parameters to
     * ensure at least one of the required parameters exists.
     *
     * NOTE: The Meetup API contains a list of parameters that are required for
     * each endpoint with a default condition of "any of"
     * 
     * @param Array $RequiredList - Names of required parameters
     * @param Array $Parameters - List of provided paramters
     * @return Boolean
     */
    public function verifyParameters($RequiredList, $Parameters) {
        $Parameters = array_keys($Parameters);

        /*
         * Check to see if any of the required list is in the parameters array
         * Since the Meetup API requires "any of" if a required key is found in
         * parameters the verification will pass
         */
        foreach($RequiredList AS $r) {
            if(in_array($r, $Parameters)) {
                return true;
            }
        }
        return false;
    }

} // end class
