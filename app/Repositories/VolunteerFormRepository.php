<?php

namespace App\Repositories;

use App\Contracts\IVolunteerFormRepository;
use App\Models\VolunteerFormStatus;
use App\VolunteerForm;
use Carbon\Carbon;
use DateTime;

/**
 * Class VolunteerFormRepository
 * @package App\Repositories
 */
class VolunteerFormRepository implements IVolunteerFormRepository
{
    private $form;

    /**
     * Default constructor. We are injecting our db model so we can use it.
     * @param $form - Db model that is being injected.
     */
    public function __construct(VolunteerForm $form)
    {
        $this->form = $form;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->form->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->form->find($id);
    }

    /**
     * @return mixed
     */
    public function getAllNewForms()
    {
        return $this->form->where('form_status', '=', VolunteerFormStatus::NEW)->get();
    }

    /**
     * @return array
     */
    public function getAllPreviousAcceptedOrganizationNames()
    {

        $items = $this->form
            ->where('form_status', '=', VolunteerFormStatus::APPROVED)
            ->where('event_date_time', '<', Carbon::now())
            ->get();
        $results = array();

        foreach($items as $item){
            array_push($results, $item['organization_name']);
        }
        $results = array_unique($results);
        return $results;

    }

    /**
     * @param $input
     * @return mixed
     */
    public function create($input)
    {
        $this->form->fill([
            'organization_name' => $input['organization_name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'meal_description' => $input['meal_description'],
            'notes' => $input['notes'] ?? '',
            'paper_goods' => $input['paper_goods'] ?? false,
            'open_event_id' => $input['open_event_id'],
            'event_date_time' => new DateTime($input['open_event_date_time']),
            'form_status' => VolunteerFormStatus::NEW,
        ]);

        $this->form->save();

        return $this->form->id;
    }

    /**
     * @param $input
     * @param $status
     */
    public function update($input, $status)
    {
        $this->form->where('id',$input['volunteer_id'])->update([
                'organization_name' => $input['organization_name'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'meal_description' => $input['meal_description'],
                'notes' => $input['notes'] ?? '',
                'paper_goods' => $input['paper_goods'] ,
                'form_status' => $status
        ]);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $form = $this->form->find($id);
        $form->delete();
    }

    /**
     * @param $volunteerId
     * @param $confirmedEventId
     */
    public function approve($volunteerId, $confirmedEventId)
    {
        $this->form->where('id', $volunteerId)->update(['form_status' => VolunteerFormStatus::APPROVED, 'confirmed_event_id' => $confirmedEventId]);
    }

    /**
     * @param $volunteerId
     */
    public function deny($volunteerId){
        $this->form->where('id', $volunteerId)->update(['form_status' => VolunteerFormStatus::DENIED]);
    }

    /**
     * @param $volunteerId
     */
    public function cancelled($volunteerId){
        $this->form->where('id', $volunteerId)->update(['form_status' => VolunteerFormStatus::CANCELLED]);
    }

    /**
     * @param $openEventId
     * @return
     */
    public function getOpenEventCount($openEventId)
    {
        return $this->form->where(['open_event_id'=> $openEventId, 'form_status' => VolunteerFormStatus::APPROVED])->count();
    }

}