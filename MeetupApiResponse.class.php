<?php
/**
 * This object manages the results from the Meetup API calls inside the
 * MeetupApiRequest object. Multiple MeetupApiResponses can be available at one
 * time with responses.
 *
 * @author Ben Lobaugh <ben@lobaugh.net>
 * @license Nothing yet
 */
class MeetupApiResponse implements ArrayAccess, Iterator{

    private $mHttpCode;

    private $mResponse;

    private $mError = false;
    


    /**
     * Sets the HTTP response code from the API call
     * @param Integer $Code
     */
    public function setHttpCode( $Code ) {
        $this->mHttpCode = $Code;

        // If the response was not a 200 there was an error. Set the error code
        if( '200' != $Code ) {
            $this->mError = true;
        }
    }

    /**
     * Returns the HTTP response code from the API query
     * @return Integer
     */
    public function getHttpCode() {
        return $this->mHttpCode;
    }

    /**
     * Brings in the response from the API call and converts it to a stdClass
     * 
     * @param JSON $Response
     */
    public function setResponse($Response) {
        $this->mResponse = json_decode($Response, true);
        //dBug($this->mResponse);
    }

    public function getResponse() {
        return $this->mResponse;
    }

    /**
     * Check if there was an error with the API query
     *
     * @return Boolean
     */
    public function isError() {
        return $this->mError;
    }


    /*
     * ************************************************************************
     *  Below this point are overloaded PHP functions to enable arraylike access
     *  You should not need to change anything beyond this line
     * ************************************************************************
     */

    /*
     * Array Access methods
     * Used directly from PHP docs
     * http://php.net/manual/en/class.arrayaccess.php
     */
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->mResponse[] = $value;
        } else {
            $this->mResponse[$offset] = $value;
        }
    }
    public function offsetExists($offset) {
        return isset($this->mResponse[$offset]);
    }
    public function offsetUnset($offset) {
        unset($this->mResponse[$offset]);
    }
    public function offsetGet($offset) {
        return isset($this->mResponse[$offset]) ? $this->mResponse[$offset] : null;
    }

    /*
     * Iterator methods
     * Used directly from PHP docs
     * http://php.net/manual/en/language.oop5.iterations.php
     */
    public function rewind() {
        reset($this->mResponse);
    }

    public function current() {
        return current($this->mResponse);
    }

    public function key() {
        return key($this->mResponse);
    }

    public function next() {
        return next($this->mResponse);
    }

    public function valid() {
        $key = key($this->mResponse);
        return ($key !== NULL && $key !== FALSE);
    }
    
} // end class