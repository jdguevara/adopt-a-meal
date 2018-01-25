<?php

namespace App;
use DateTime;

class VolunteerForms
{
    protected $table = 'volunteer_forms';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'organization_name', 'phone', 'email', 'meal_description',
        'notes', 'food_confirmation', 'tableware_confirmation',
        'form_status', 'open_event_id', 'event_date_time', 'confirmed_event_id'
    ];

    function getNewVolunteerForms() {

        $results = array();

        // These will be removed by database items
        $dateTime = new DateTime();
        $dateTime->setTime($dateTime->format('h'), 0, 0);
        $result = array(
            "organization_name" =>"Boise State",
            "email" => "test@test.com",
            "phone" => "9998887776",
            "notes" => "Test",
            "date" => $dateTime->format('m/d/Y h:i')
        );
        array_push($results, $result);
        $dateTime->add(new \DateInterval("P0Y1DT8H0M"));
        $result = array(
            "organization_name" => "Computer Science Dept",
            "email" => "test@csboisestate.com",
            "notes" => "TestTest",
            "date" => $dateTime->format('m/d/Y h:i')
        );
        array_push($results, $result);
        $dateTime->add(new \DateInterval("P0Y3DT6H0M"));
        $result = array(
            "organization_name" => "Test Organization",
            "email" => "test@idaho.gov",
            "notes" => "TestTestTest",
            "date" => $dateTime->format('m/d/Y h:i')
        );
        array_push($results, $result);
        $dateTime->add(new \DateInterval("P0Y3DT6H0M"));
        $result = array(
            "organization_name" => "Interfaith Sanctuary",
            "email" => "test@interfaith.com",
            "notes" => "TestTestTestTest",
            "date" => $dateTime->format('m/d/Y h:i')
        );
        array_push($results, $result);
        $dateTime->add(new \DateInterval("P0Y1M8DT6H0M"));
        $result = array(
            "organization_name" => "City Of Boise",
            "email" => "test@idaho.boise.gov",
            "notes" => "TestTestTestTestTest",
            "date" => $dateTime->format('m/d/Y h:i')
        );
        array_push($results, $result);

        return $results;

    }
}
