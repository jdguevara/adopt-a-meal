<?php

namespace App\Services;

use App\Contracts\IVolunteerFormRepository;
use App\VolunteerForm;

class VolunteerFormRepository implements IVolunteerFormRepository
{
    private $form;

    public function __construct(VolunteerForm $form)
    {
        $this->form = $form;
    }

    public function all()
    {
        $this->form->all();
    }

    public function get($id)
    {
        return $this->form->find($id);
    }

    public function getAllNewForms()
    {
        return $this->form->where('form_status', '=', 0)->get();
    }

    public function create($input)
    {
        $this->form->fill([
            'organization_name' => $input['organization_name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'meal_description' => $input['meal_description'],
            'notes' => $input['notes'] ?? '',
            'food_confirmation' => $input['bringing_food'] ?? false,
            'tableware_confirmation' => $input['bringing_tableware'] ?? false,
            'open_event_id' => $input['open_event_id'],
            'event_date_time' => $input['open_event_date_time'],
            'form_status' => 0,
        ]);

        $this->form->save();

        return $this->form->id;
    }

    public function update($form, $input)
    {
        $form = $this->form->find($form->id);
        $form->fill([
            'organization_name' => $input['organization_name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'meal_description' => $input['meal_description'],
            'notes' => $input['notes'] ?? '',
            'food_confirmation' => $input['food_confirmation'] ?? false,
            'tableware_confirmation' => $input['tableware_confirmation'] ?? false,
            'open_event_id' => $input['open_event_id'],
            'event_date_time' => $input['open_event_date_time'],
            'form_status' => 0,
        ]);

        $this->form->save();
    }

    public function delete($id)
    {
        $form = $this->form->find($id);
        $form->delete();
    }
}