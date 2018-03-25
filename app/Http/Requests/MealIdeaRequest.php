<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MealIdeaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

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