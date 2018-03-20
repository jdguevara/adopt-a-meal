<?php

namespace App\Services;

use App\Contracts\ICalendarRepository;
use App\Contracts\IVolunteerFormRepository;
use App\VolunteerForm;
use Carbon\Carbon;
use DateTime;

class VolunteerFormRepository implements IVolunteerFormRepository
{
    private $form;
    protected $calendarRepository;

    public function __construct(VolunteerForm $form, ICalendarRepository $ICalendarRepository)
    {
        $this->calendarRepository = $ICalendarRepository;
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

    public function getConfirmedEvents()
    {
        return $this->form->where('form_status', '=', 1)->get();
    }

    public function getAllNewForms()
    {
        return $this->form->where('form_status', '=', 0)->get();
    }
    public function getAllPreviousAcceptedOrganizationNames()
    {

        $items = $this->form
            ->where('form_status', '=', 1)
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
            'title' => $input['organization_name'],
            'organization_name' => $input['organization_name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'meal_description' => $input['meal_description'],
            'notes' => $input['notes'] ?? '',
            'paper_goods' => $input['paper_goods'] ?? false,
            'open_event_id' => $input['open_event_id'],
            'event_date_time' => new DateTime($input['open_event_date_time']),
            'form_status' => 0,
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
                'open_event_id' => $input['open_event_id'],
                'event_date_time' => new DateTime($input['open_event_date_time']),
                'form_status' => $status
        ]);
    }

    public function delete($id)
    {
        $form = $this->form->find($id);
        $form->delete();
    }

    public function approve($volunteerId, $openEventId)
    {
        $this->form->where('id', $volunteerId)->update(['form_status' => 1]);
    }

    public function deny($volunteerId){
        $this->form->where('id', $volunteerId)->update(['form_status' => 2]);
    }

}