<?php
namespace App;

use Google_Client;
use Google_Service_Calendar;
use DateTime;
use DateInterval;
use Carbon\Carbon;

define('APPLICATION_NAME', env('APP_NAME'));
define('CREDENTIALS_PATH', storage_path('app/service_account_creds.json'));
define('SCOPES', implode(' ', array(Google_Service_Calendar::CALENDAR)));
define('DEV_CALENDAR_ID', env('DEV_CALENDAR_ID'));
define('DEV_CALENDAR_ACCEPTED_ID', env('DEV_CALENDAR_ACCEPTED_ID'));

class Calendar
{

    protected $calendarService;
    protected $calendarId;
    protected $acceptedCalendarId;
    /**
     * Authorizes an API client and adds a calendar object as a singleton.
     */
    function setupCalendar() {

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . CREDENTIALS_PATH);

        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setScopes(SCOPES);

        $cal = new Google_Service_Calendar($client);
        $this->calendarService = $cal;
        $this->calendarId = DEV_CALENDAR_ID;
        $this->acceptedCalendarId = DEV_CALENDAR_ACCEPTED_ID;
    }

    function findVolunteerEvents() {

        $time = new DateTime();
        $time->sub(new DateInterval('P1M'));

        if(!$this->calendarService) {
            $this->setupCalendar();
        }

        $optParams = array(
            'maxResults' => 100,
            'orderBy' => 'startTime',
            'singleEvents' => TRUE,
            'timeMin' => Carbon::now()->toIso8601String(),
            'timeMax' => Carbon::now()->addMonths(3)->toIso8601String()
        ); 

        $results = $this->calendarService->events->listEvents($this->calendarId, $optParams)->getItems();

        return $results;

    }
    function findAllAccepted(){

        if(!$this->calendarService) {
            $this->setupCalendar();
        }

        $optParams = array(
            'maxResults' => 100,
            'orderBy' => 'startTime',
            'singleEvents' => TRUE,
            'timeMax' => Carbon::now()->addMonths(3)->toIso8601String()
        );

        $results = $this->calendarService->events->listEvents($this->acceptedCalendarId, $optParams)->getItems();

        return $results;
    }

}