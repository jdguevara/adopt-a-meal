<?php

namespace App;

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

    function findAll() {

        $results = array();

        $result = array(
            "organization" =>"Boise State",
            "email" => "test@test.com",
            "notes" => "Test"
        );
        array_push($results, json_encode($result));
        $result = array(
            "organization" => "Computer Science Dept",
            "email" => "test@csboisestate.com",
            "notes" => "TestTest"
        );
        array_push($results, json_encode($result));
        $result = array(
            "organization" => "Test Organization",
            "email" => "test@idaho.gov",
            "notes" => "TestTestTest"
        );
        array_push($results, json_encode($result));
        $result = array(
            "organization" => "Interfaith Sanctuary",
            "email" => "test@interfaith.com",
            "notes" => "TestTestTestTest"
        );
        array_push($results, json_encode($result));

        return $results;

    }
}
