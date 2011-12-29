<?php

// API authoriaztion type
define( 'MEETUP_AUTH_KEY', 'key' );
define( 'MEETUP_AUTH_OATUH2', 'oauth2' );

require_once( 'meetup_config.php' );

// Choose the authorization type
define( 'MEETUP_AUTH_TYPE', $meetup_auth_type );

// Meetup.com API Key
//define( 'MEETUP_API_KEY' , '<PUT YOUR MEETUP API KEY HERE - http://www.meetup.com/meetup_api/key/>' );
define( 'MEETUP_API_KEY', $meetup_api_key);

// Meetup.com API URL
define( 'MEETUP_API_URL', 'https://api.meetup.com' );


// API Endpoints
define('MEETUP_ENDPOINT_CHECKINS', '/2/checkins');

define('MEETUP_ENDPOINT_EVENTS', '/2/events');
define('MEETUP_ENDPOINT_EVENT', '/2/event');
define('MEETUP_ENDPOINT_OPEN_EVENTS', '/2/open_events');
define('MEETUP_ENDPOINT_EVENT_COMMENTS', '/2/event_comments');
define('MEETUP_ENDPOINT_EVENT_RATINGS', '/2/event_ratings');

define('MEETUP_ENDPOINT_FEED_ACTIVITY', '/activity');

define('MEETUP_ENDPOINT_GROUPS', '/2/groups');
define('MEETUP_ENDPOINT_GROUP_COMMENTS', '/comments');

define('MEETUP_ENDPOINT_MEMBERS', '/2/members');
define('MEETUP_ENDPOINT_MEMBER', '/2/member');
define('MEETUP_ENDPOINT_PROFILES', '/2/profiles');

define('MEETUP_ENDPOINT_PHOTO_COMMENTS', '/2/photo_comments');
define('MEETUP_ENDPOINT_PHOTO_ALBUMS', '/2/photo_albums');
define('MEETUP_ENDPOINT_PHOTOS', '/2/photos');

define('MEETUP_ENDPOINT_RSVPS', '/2/rsvps');

define('MEETUP_ENDPOINT_TOPICS', '/topics');

define('MEETUP_ENDPOINT_OPEN_VENUES', '/2/open_venues');
define('MEETUP_ENDPOINT_VENUES', '/2/venues');

// Setup includes - this should be an autoloader soon
require_once('MeetupApiResponse.class.php');
require_once('MeetupApiRequest.class.php');
require_once('MeetupExceptions.class.php');

require_once('MeetupCheckins.class.php');
require_once('MeetupEvents.class.php');
require_once('MeetupFeeds.class.php');
require_once('MeetupGroups.class.php');
require_once('MeetupMembers.class.php');
require_once('MeetupPhotos.class.php');
require_once('MeetupRsvps.class.php');
require_once('MeetupTopics.class.php');
require_once('MeetupVenues.class.php');