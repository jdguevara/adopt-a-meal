<?php


namespace App\Contracts;


use App\VolunteerForm;

interface IVolunteerFormRepository
{

    /**
     * Get all volunteers
     * @return array VolunteerForm
     */
    public function all();

    /**
     * Get all volunteers within a certain period. The month passed in will determine the period, starting
     * on the first of the month and ending on the last day of the month.
     * @param $month Carbon the month to generate starting/ending time period from
     * @return array VolunteerForm
     */
    public function allByMonth($month);

    /**
     * Get a single volunteer by their database ID.
     * @return VolunteerForm
     */
    public function get($id);

    /**
     * Get all volunteer forms that have not been approved by an admin yet.
     * @return array VolunteerForm
     */
    public function getAllNewForms();

    /**
     * Create a new volunteer form.
     * @param $input
     * @return VolunteerForm
     */
    public function create($input);

    /**
     * Update an existing volunteer form.
     * @param $form VolunteerForm the input of the request
     * @param $status Integer the status of the volunteer (pending, approved, cancelled)
     * @return VolunteerForm
     */
    public function update($form, $status);

    /**
     * Remove a volunteer form from the database.
     * @param $id
     */
    public function delete($id);

    /**
     * Mark a volunteer approved for the event they applied for.
     * @param $volunteerId Integer database ID of the volunteer
     * @param $confirmedEventId String the id of the confirmed event in Google Calendar
     */
    public function approve($volunteerId, $confirmedEventId);

    /**
     * Mark a volunteer denied for the event they applied for.
     * @param $volunteerId Integer the ID of the volunteer to deny
     */
    public function deny($volunteerId);

    /**
     * Mark a volunteer as cancelled for the event they applied for.
     * @param $volunteerId Integer the ID of the volunteer to cancel
     */
    public function cancelled($volunteerId);

    /**
     * Get a head-count of all volunteers that have applied to the open event
     * @param $openEventId String the open event Google Calendar ID
     * @return Integer the count of volunteers that have applied for this event
     */
    public function getOpenEventCount($openEventId);
}