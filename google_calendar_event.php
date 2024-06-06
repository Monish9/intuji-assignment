<?php

create_google_calendar_events();
//add_action('wp_footer', 'create_google_calendar_events');
function create_google_calendar_events()
{
    $credentials = __DIR__.'/credentials.json';
    require __DIR__.'/vendor/autoload.php';
   

    $client = new Google_Client();
    $client->setApplicationName('test06');
    $client->setScopes(array(Google_Service_Calendar::CALENDAR));
    $client->setAuthConfig($credentials);
    $client->setAccessType('offline');
    $client->getAccessToken();
    $client->getRefreshToken();

    $service = new Google_Service_Calendar($client);

    $event = new Google_Service_Calendar_Event(array(
        'summary' => 'testing',
        'Location' => '800 Howard St., San Francisco, CA 94183',
        'description' => 'A chance to hear about google development products',
        'start' => array(
            'date' => '2024-06-05',
            
        ),
        'end' => array(
            'date' => '2024-06-05',
            
        ),
        'attendees' => array(),
        'reminders' => array(
            'useDefault' => FALSE,
            'overrides' => array(
                array('method' => 'email', 'minutes' => 24 * 60),
                array('method' => 'popup', 'minutes' => 10),
            ),
        ),
    ));

    $calendarId = 'monish.manandhar@gmail.com';
    $event = $service->events->insert($calendarId, $event);
    print_r($event->htmlLink);
}
?>