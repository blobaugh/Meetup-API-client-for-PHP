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


} // end class
