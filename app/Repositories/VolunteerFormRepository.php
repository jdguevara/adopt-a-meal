<?php

namespace App\Repositories;

use App\Contracts\IVolunteerFormRepository;
use App\Models\VolunteerFormStatus;
use App\VolunteerForm;
use Carbon\Carbon;
use DateTime;

class VolunteerFormRepository implements IVolunteerFormRepository
{
    private $form;

    public function __construct(VolunteerForm $form)
    {
        $this->form = $form;
    }

    public function all()
    {
        return $this->form->all();
    }

    public function get($id)
    {
        return $this->form->find($id);
    }

    public function getAllNewForms()
    {
        return $this->form->where('form_status', '=', VolunteerFormStatus::NEW)->get();
    }
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

    public function update($input, $status)
    {
        $form = $this->form->where('id',$input['volunteer_id'])
        ->update([
                'organization_name' => $input['organization_name'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'meal_description' => $input['meal_description'],
                'notes' => $input['notes'] ?? '',
                'paper_goods' => $input['paper_goods'] ,
                'form_status' => $status
        ]);
    }

    public function delete($id)
    {
        $form = $this->form->find($id);
        $form->delete();
    }

    public function approve($volunteerId, $confirmedEventId)
    {
        $this->form->where('id', $volunteerId)->update(['form_status' => VolunteerFormStatus::APPROVED, 'confirmed_event_id' => $confirmedEventId]);
    }

    public function deny($volunteerId){
        $this->form->where('id', $volunteerId)->update(['form_status' => VolunteerFormStatus::DENIED]);
    }

    public function cancelled($volunteerId){
        $this->form->where('id', $volunteerId)->update(['form_status' => VolunteerFormStatus::CANCELLED]);
    }
    public function getOpenEventCount($openEventId)
    {
        return $this->form->where(['open_event_id'=> $openEventId, 'form_status' => VolunteerFormStatus::APPROVED])->count();
    }

}