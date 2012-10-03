<?php





class MeetupApiRequest {

    private $_conn;

    /**
     * @param MeetupConnection The connection instance
     */
    public function __construct($conn) {
        $this->_conn = $conn; 
    }

    public function get( $Url ) {
        return $this->_conn->get( $Url );
    }

    public function buildUrl( $EndPoint, $Parameters, $RequiredParameters = null ) {
        return $this->_conn->buildUrl( $EndPoint, $Parameters, $RequiredParameters );
    }
    
    public function query( $EndPoint, $Parameters, $RequiredParameters = null ) {
        $url = $this->buildUrl( MEETUP_ENDPOINT_EVENTS, $Parameters, $required_params );
        $response =  $this->get( $url )->getResponse();
        return $response['results'];
    }


} // end class
