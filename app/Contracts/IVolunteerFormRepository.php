<?php


namespace App\Contracts;


interface IVolunteerFormRepository
{
    public function all();

    public function get($id);

    public function getAllNewForms();

    public function create($input);

    public function update($form, $status);

    public function delete($id);

    public function approve($id, $eventId);

    public function deny($volunteerId);

}