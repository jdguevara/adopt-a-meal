<?php

namespace App\Services;

use App\Contracts\IVolunteerFormRepository;
use App\VolunteerForms;

class VolunteerFormRepository implements IVolunteerFormRepository
{
    private $form;

    public function __construct(VolunteerForms $form)
    {
        $this->form = $form;
    }

    public function all()
    {
        $this->form->all();
    }

    public function get($id)
    {
        return $this->form->findOrFail($id);
    }

    public function create($input)
    {
        $this->form->fill([
            'organization_name' => $input['organization_name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'meal_description' => $input['meal_description'],
            'notes' => $input['notes'] ?? '',
            'food_confirmation' => $input['food_confirmation'] ?? 0,
            'tableware_confirmation' => $input['tableware_confirmation'] ?? 0,
            'form_status' => 0,
        ]);

        $this->form->save();
    }

    public function update($input)
    {
        // TODO
    }

    public function delete($id)
    {
        $form = $this->form->find($id);
        $form->delete();
    }

    public function find($id)
    {
        $form = $this->form->find($id);
        return $form;
    }
}