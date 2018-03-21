<?php
namespace App\Services;

use App\Contracts\ICalendarRepository;
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

class CalendarRepository implements ICalendarRepository {

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

    public function getVolunteerEvents()
    {
        $time = new DateTime();
        $time->sub(new DateInterval('P1M'));

        $optParams = array(
            'maxResults' => 100,
            'orderBy' => 'startTime',
            'singleEvents' => TRUE,
            'timeMin' => Carbon::now()->toIso8601String(),
            'timeMax' => Carbon::now()->addMonths(12)->toIso8601String()
        );

        $results = $this->googleCalendarService->events->listEvents($this->openCalendarId, $optParams)->getItems();

        return $results;
    }

    public function getConfirmedEvents()
    {

        $optParams = array(
            'maxResults' => 100,
            'orderBy' => 'startTime',
            'singleEvents' => TRUE,
            'timeMax' => Carbon::now()->addMonths(12)->toIso8601String()
        );

        $results = $this->googleCalendarService->events->listEvents($this->acceptedCalendarId, $optParams)->getItems();

        return $results;
    }

    public function createConfirmedVolunteerEvent($event)
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

        return $this->googleCalendarService->events->insert($this->acceptedCalendarId, $calendar_event);
    }

    public function updateVolunteerEvent($details)
    {
        $calendar_event = new Google_Service_Calendar_Event(array(
            'summary' => $details->organization_name,
            'description' => $details->meal_description,
            'start' => array(
                'date' => Carbon::parse($details->event_date_time)->format('Y-m-d')
            ),
            'end' => array(
                'date' => Carbon::parse($details->event_date_time)->format('Y-m-d')
            )
        ));

        return $this->googleCalendarService->events->update($this->acceptedCalendarId, $details->confirmed_event_id, $calendar_event);
    }

    public function cancelVolunteerEvent($event)
    {
        $this->googleCalendarService->events->delete($this->acceptedCalendarId, $event->confirmed_event_id);

        $calendar_event = new Google_Service_Calendar_Event(array(
            'summary' => "Click to Adopt-A-Meal!",
            'status' => "confirmed",
            'start' => array(
                'date' => Carbon::parse($event->event_date_time)->format('Y-m-d')
            ),
            'end' => array(
                'date' => Carbon::parse($event->event_date_time)->format('Y-m-d')
            )
        ));

        return $this->googleCalendarService->events->update($this->openCalendarId, $event->open_event_id, $calendar_event);
    }

    public function deleteOpenEvent($id)
    {
        return $this->googleCalendarService->events->delete($this->openCalendarId, $id);
    }

    public function all($eventType)
    {
        // TODO: Implement all() method.
    }

    public function get($id, $eventType)
    {
        // TODO: Implement get() method.
    }
}