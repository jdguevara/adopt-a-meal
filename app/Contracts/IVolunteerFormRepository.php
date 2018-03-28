<?php


namespace App\Contracts;


use Illuminate\Support\Carbon;

interface IVolunteerFormRepository
{
    public function all();

    public function allByMonth($month);

    public function get($id);

    public function getAllNewForms();

    public function create($input);

    public function update($form, $status);

    public function delete($id);

    public function approve($id, $eventId);

    public function deny($volunteerId);

    public function cancelled($volunteerId);
    
    public function getOpenEventCount($openEventId);
}