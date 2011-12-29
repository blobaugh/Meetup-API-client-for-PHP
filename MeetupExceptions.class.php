<?php
/**
 * Contains all of the exceptions for the Meetup API Client
 */



/**
 * Used when invalid parameters are passed to the API 
 */
class MeetupInvalidParametersException extends Exception {
    // Redefine the exception so message isn't optional
    public function __construct( $RequiredParameters ) {
        // some code
        $message = "<p><b>A required parameter was not found.</b> Please view the list of parameters: " . implode(", ", $RequiredParameters) . "</p>";
        // make sure everything is assigned properly
        parent::__construct( $message, E_USER_ERROR, null );
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": {$this->message}\n";
    }
}

// 400 Bad request when there was a problem with the request
class MeetupBadRequestException extends Exception {
    // Redefine the exception so message isn't optional
    public function __construct($Url, $Response) {
        // some code
        $message = "<p><b>400 HTTP Error:</b> Error bad request to $Url<br/>Details: {$Response['details']}<br/>Problem: {$Response['problem']}</p>";

        // make sure everything is assigned properly
        parent::__construct($message, E_USER_ERROR, null);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": {$this->message}\n";
    }
}


class MeetupUnauthorizedRequestException extends Exception {
    // Redefine the exception so message isn't optional
    public function __construct() {
        // some code
        $message = "<p><b>401 HTTP Error:</b> Error not authorized. Please check your Meetup API credentials</p>";

        // make sure everything is assigned properly
        parent::__construct($message, E_USER_ERROR, null);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": {$this->message}\n";
    }
}

class MeetupInternalServerErrorException extends Exception {
    // Redefine the exception so message isn't optional
    public function __construct() {
        // some code
        $message = "<p><b>500 HTTP Error:</b> Internal server error. The Meetup servers are currently experiencing difficulty</p>";

        // make sure everything is assigned properly
        parent::__construct($message, E_USER_ERROR, null);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": {$this->message}\n";
    }
}