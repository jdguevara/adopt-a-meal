<?php

use App\Contracts\ICalendarRepository;
use Illuminate\Support\Carbon;

/**
 * Created by PhpStorm.
 * User: zacharymikel
 * Date: 2/10/18
 * Time: 7:48 PM
 */

define('APPLICATION_NAME', env('APP_NAME'));
define('CREDENTIALS_PATH', storage_path('app/service_account_creds.json'));
define('SCOPES', implode(' ', array(Google_Service_Calendar::CALENDAR)));
define('DEV_CALENDAR_ID', env('DEV_CALENDAR_ID'));
define('DEV_CALENDAR_ACCEPTED_ID', env('DEV_CALENDAR_ACCEPTED_ID'));

class CalendarRepository implements ICalendarRepository {

    protected $googleCalendarService;
    protected $calendarId;
    protected $acceptedCalendarId;

    public function __construct()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . CREDENTIALS_PATH);

        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setScopes(SCOPES);

        $cal = new Google_Service_Calendar($client);
        $this->googleCalendarService = $cal;
        $this->calendarId = DEV_CALENDAR_ID;
        $this->acceptedCalendarId = DEV_CALENDAR_ACCEPTED_ID;
    }

    public function getVolunteerEvents()
    {
        $time = new DateTime();
        $time->sub(new DateInterval('P1M'));

        if(!$this->googleCalendarService) {
            $this->setupCalendar();
        }

        $optParams = array(
            'maxResults' => 100,
            'orderBy' => 'startTime',
            'singleEvents' => TRUE,
            'timeMin' => Carbon::now()->toIso8601String(),
            'timeMax' => Carbon::now()->addMonths(3)->toIso8601String()
        );

        $results = $this->googleCalendarService->events->listEvents($this->calendarId, $optParams)->getItems();

        return $results;
    }

    public function getAcceptedEvents()
    {

        $optParams = array(
            'maxResults' => 100,
            'orderBy' => 'startTime',
            'singleEvents' => TRUE,
            'timeMax' => Carbon::now()->addMonths(3)->toIso8601String()
        );

        $results = $this->googleCalendarService->events->listEvents($this->acceptedCalendarId, $optParams)->getItems();

        return $results;
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
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