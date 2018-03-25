<?php
namespace App\Services;

use App\Contracts\ICalendarService;
use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use DateTime;
use DateInterval;
use Google_Service_Calendar_Event;

define('APPLICATION_NAME', env('APP_NAME'));
define('CREDENTIALS_PATH', storage_path('app/service_account_creds.json'));
define('SCOPES', implode(' ', array(Google_Service_Calendar::CALENDAR)));
define('CALENDAR_ID', env('CALENDAR_ID'));
define('CONFIRMED_CALENDAR_ID', env('CONFIRMED_CALENDAR_ID'));

class CalendarService implements ICalendarService {

    protected $googleCalendarService;
    protected $openCalendarId;
    protected $acceptedCalendarId;

    public function __construct()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . CREDENTIALS_PATH);

        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setScopes(SCOPES);

        $cal = new Google_Service_Calendar($client);
        $this->googleCalendarService = $cal;
        $this->openCalendarId = CALENDAR_ID;
        $this->acceptedCalendarId = CONFIRMED_CALENDAR_ID;
    }

    // Updates Calendar Event On Form Edit
    public function update($calendarId, $event)
    {
        $calendar_event = new Google_Service_Calendar_Event(array(
            'summary' => $event->organization_name,
            'description' => $event->meal_description,
        ));

        return $this->googleCalendarService->events->patch($calendarId, $event->confirmed_event_id, $calendar_event);
    }

    //Creates New Event
    public function create($calendarId, $event)
    {
        $calendar_event = new Google_Service_Calendar_Event(array(
            'summary' => $event->organization_name,
            'description' => $event->meal_description,
            'start' => array(
                'date' => Carbon::parse($event->event_date_time)->format('Y-m-d')
            ),
            'end' => array(
                'date' => Carbon::parse($event->event_date_time)->format('Y-m-d')
            )
        ));

        return $this->googleCalendarService->events->insert($calendarId, $calendar_event);
    }

    //Changes Calendar Status For Event
    public function patch($calendarId, $eventId, $status){
        $calendarEvent = new Google_Service_Calendar_Event(array(
            'status' => $status
        ));
        $this->googleCalendarService->events->patch($calendarId, $eventId, $calendarEvent);
    }

}