<?php

namespace App\Http\Controllers;
use App\Google;
use Google_Service_Calendar;

class LandingPageController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Google $google)
    {
        $client = $google->getClient();
        $service = new Google_Service_Calendar($client);

        $calendarId = 'primary';
        $options = array(
            'maxResults' => 10,
            'orderBy' => 'startTime',
            'singleEvents' => TRUE,
            'timeMin' => date('c'),
        );

        $results = $service->events->listEvents($calendarId, $options);
        $events = $results->getItems();

        return view('welcome', ['events' => $events]);
    }

}