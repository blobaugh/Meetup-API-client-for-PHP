# Meetup API client for PHP
Meetup (http://meetup.com) is a social networking site based around community groups. Meetup provides an API to access their platform services from remote applications to manage authentication, events, rsvps and more.

Until now a good PHP client for the Meetup API has not existed. This project aims to bridge that gap by providing a high quality stand alone Meetup API PHP client. This client is simple to use through provided classes and also allows powerful advanced usage through direct queries to the API

*NOTE:* This project currently only supports GET requests to the Meetup API

## Supported endpoints
/2/checkins
/2/events
/2/event
/2/open_events
/2/event_comments
/2/event_ratings
/activity
/2/groups
/comments
/2/members
/2/member
/2/profiles
/2/photo_comments
/2/photo_albums
/2/photos
/2/rsvps
/topics
/2/open_venues
/2/venues

# Documentation
Full documentation can be found on the Github project wiki at https://github.com/blobaugh/Meetup-API-client-for-PHP/wiki

# How to setup the library
- Download the files from Github and place them in the PHP application directory
- * I.E. /var/www/myapp/Meetup-API-client-for-PHP
- Include the Meetup.php file in your application
- * I.E. In /var/www/myapp/index.php
- * Use require_once('Meetup-API-client-for-PHP/Meetup.php');
- Edit Meetup.php and set your Meetup API key
- * define( 'MEETUP_API_KEY' , '<PUT YOUR MEETUP API KEY HERE - http://www.meetup.com/meetup_api/key/>' );
- Begin using the new Meetup functionality in your application!

# Using the pre-built endpoint classes
The Meetup API client for PHP allows developers to make direct calls to the Meetup API, however for convenience several helper classes have been created.
Each class corresponds directly to a grouping of endpoints from the Meetup API documentation.
These classes take an associative array of parameters that correspond to the parameters in the Meetup API documentation.

Example: Accessing all Meetup events for user Ben Lobaugh with ID 14508967. See http://www.meetup.com/meetup_api/docs/2/events/ for additional parameters and response format

$m = MeetupEvents();
$events = $m->getEvents( array( 'member_id' => '14508967' ) );

$events will be in the form of an associative array

Consult the Meetup API documentation for parameters used by each endpoint
http://www.meetup.com/meetup_api/docs

# Direct queries to the Meetup API
The Meetup API client for PHP supports direct API queries  if a helper class is not available.
Queries are sent to the MeetupApiRequest class and data recieved from the Meetup API will be returned in the MeetupApiResponse class.
The MeetupApiResponse object will contain the HTTP code and API response. To use the MeetupApiReponse class a developer simply calls the query method with an endpoint and parameters.

Example: Accessing all Meetup events for user Ben Lobaugh with ID 14508967. See http://www.meetup.com/meetup_api/docs/2/events/ for additional parameters and response format

$m = new MeetupApiRequest();
$events = $m->query( MEETUP_ENDPOINT_EVENTS, array( 'member_id' => '14508967' ) );

$events will be a MeetupApiResponse object that can be access like an array (E.G. $events['results']) or used in a loop to view each event entry (E.G. foreach( $events AS $event ) )
The HTTP response code can be checked with $events->getHttpCode()

# Exceptions
Exceptions will usually occur when an invalid API request is recieved. The following is a list of all the Meetup API client for PHP specific exceptions

- MeetupInvalidParametersException - Invalid or missing parameters passed to the API endpoint
- MeetupBadRequestException - Problem with the request
- MeetupUnauthorizedRequestException - Invalid API key
- MeetupInternalServerErrorException - Problem exists with the Meetup API server

# Development Roadmap

- oAuth integration - High priority
- POST support
- everywhere endpoints implementation

If you would like to see specific new developments please feel free to contribute through code of financial incentives.

