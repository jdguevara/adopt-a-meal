<?php

namespace App\Http\Requests;

class MealIdeaRequest extends Request
{
    public function rules()
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'ingredients_json' => 'nullable',
            'external_link' => 'nullable',
            'name' => 'nullable',
            'email' => 'nullable',
            'meal_idea_status' => 'required',
        ];
        return $rules;
    }
}