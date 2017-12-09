<?php

namespace App;
use DateTime;

class VolunteerForms
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'organization', 'phone', 'email', 'notes'
    ];

    function getNewVolunteerForms() {

        $results = array();
        $dateTime = new DateTime();
        $dateTime->setTime($dateTime->format('h'), 0, 0);
        $result = array(
            "organization" =>"Boise State",
            "email" => "test@test.com",
            "notes" => "Test",
            "date" => $dateTime->format('m/d/Y h:i')
        );
        array_push($results, $result);
        $dateTime->add(new \DateInterval("P0Y1DT8H0M"));
        $result = array(
            "organization" => "Computer Science Dept",
            "email" => "test@csboisestate.com",
            "notes" => "TestTest",
            "date" => $dateTime->format('m/d/Y h:i')
        );
        array_push($results, $result);
        $dateTime->add(new \DateInterval("P0Y3DT6H0M"));
        $result = array(
            "organization" => "Test Organization",
            "email" => "test@idaho.gov",
            "notes" => "TestTestTest",
            "date" => $dateTime->format('m/d/Y h:i')
        );
        array_push($results, $result);
        $dateTime->add(new \DateInterval("P0Y3DT6H0M"));
        $result = array(
            "organization" => "Interfaith Sanctuary",
            "email" => "test@interfaith.com",
            "notes" => "TestTestTestTest",
            "date" => $dateTime->format('m/d/Y h:i')
        );
        array_push($results, $result);
        $dateTime->add(new \DateInterval("P0Y1M8DT6H0M"));
        $result = array(
            "organization" => "City Of Boise",
            "email" => "test@idaho.boise.gov",
            "notes" => "TestTestTestTestTest",
            "date" => $dateTime->format('m/d/Y h:i')
        );
        array_push($results, $result);

        return $results;

    }
}
