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
            'instructions' => 'required',
            'ingredient' => 'required',
        ];
        return $rules;
    }
}