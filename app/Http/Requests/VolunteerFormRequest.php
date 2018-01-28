<?php

namespace App\Http\Requests;

class VolunteerFormRequest extends Request
{
    public function rules()
    {
        $rules = [
            'organization_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'meal_description' => 'required',
        ];
        return $rules;
    }
}